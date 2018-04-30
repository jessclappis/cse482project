import sys
from surprise import Dataset
from surprise import Reader
import pandas as pd
from surprise import NMF

def main():
    f = open("Python/user_rated_movies.tsv","r")
    user_ratings = []
    for line in f:
        inline = line.split('\t')
        rating = inline[2]
        mytuple = inline[0], inline[1], float(rating[:-1]), None
        user_ratings.append(mytuple)
    f.close()

    # data = Dataset.load_builtin(name=u'ml-1m')
    reader = Reader(line_format='user item rating', sep='\t')
    datain = pd.read_csv("ratings.tsv", sep="\t")
    data = Dataset.load_from_df(datain, reader=reader)
    for i in user_ratings:
        data.raw_ratings.append(i)

    movies = pd.read_csv("movies.tsv", sep="\t", header=None, low_memory=False)

    algo = NMF (n_factors=4, n_epochs=100, random_state=1)
    trainSet = data.build_full_trainset()
    algo.fit(trainSet)

    predictions = []
    #have i[0] and i[1] be the current user and movie id
    for index, row in movies.iterrows():
        pred = algo.predict(user_ratings[0][0],row[1], r_ui=4)
        predictions.append(pred)

    sortpred = sorted(predictions, key=lambda pred : pred[3])
    sortpred = sortpred[-10:]

    for i in sortpred:
        print(i[1])

if __name__ == "__main__":
    main()
