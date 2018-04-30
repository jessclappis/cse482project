ratings = spark.read.csv('ratings.csv')
movies = spark.read.csv('movies.csv')
r = ratings.selectExpr("_c0 as userID", "_c1 as movieID", "_c2 as rating", "_c3 as timestamp")
m = movies.selectExpr("_c0 as movieID2", "_c1 as title", "_c2 as genres")

# join movies and ratings
data = r.join(m,r['movieID']==m['movieID2'], 'inner')
data = data.selectExpr('userID','movieID','rating','title') #EXPORT

group = data.groupBy('userID').count()  #count of ratings per user
group = group.selectExpr("userID as userID2", "count as freq")
filtered_group = group.filter(group.freq > 250) #EXPORT # only take users that have reviewed more than 250 movies

ratings = data.join(filtered_group, data['userID'] == filtered_group['userID2'], 'inner')
ratings = movies.selectExpr('userID','movieID','rating','title') #EXPORT

movie_cnts = ratings.groupBy('movieID').count() # count of movies
movie_cnts = movie_cnts.selectExpr("movieID as movieID2", "count as freq")
fil_movie_cnts = movie_cnts.filter(movie_cnts.freq > 500) #EXPORT #only take movies that have more than 100 ratings

ratings2 = ratings.join(fil_movie_cnts, ratings['movieID'] == fil_movie_cnts['movieID2'], 'inner')
ratings2 = ratings2.selectExpr('userID','movieID','rating','title')

# exports to hdfs
data.write.format('csv').save('/user/hadoop/data/data.csv')
filtered_group.write.format('csv').save('/user/hadoop/filtered_group/filtered_group.csv')
ratings.write.format('csv').save('/user/hadoop/ratings/ratings.csv')
ratings2.write.format('csv').save('/user/hadoop/ratings2/ratings2.csv'
