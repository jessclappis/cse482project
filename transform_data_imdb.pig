basics = LOAD 'title.basics.tsv' USING PigStorage('\t') AS (tconst,titleType,primaryTitle,originalTitle,isAdult,startYear,endYear,runtimeMinutes,genres);
--describe basics;
basics_trim = LIMIT basics 10;
--dump basics_trim;

ratings = LOAD 'title.ratings.tsv' USING PigStorage('\t') AS (tconst,averageRating,numVotes);
--describe ratings;
ratings_trim = LIMIT ratings 10;
--dump ratings_trim;

titles_full = JOIN basics BY tconst, ratings BY tconst;
--describe titles_full;

titles = FOREACH titles_full GENERATE basics::tconst, titleType, primaryTitle, isAdult, startYear, genres, averageRating, numVotes;
--describe titles;

filtered_titles = FILTER titles BY titleType=='movie' AND isAdult==0 AND (int) numVotes>10;
x = LIMIT filtered_titles 10;
--dump x;

movies = FOREACH filtered_titles GENERATE basics::tconst, primaryTitle, startYear, averageRating, numVotes, genres;
--describe movies;
x = LIMIT movies 10;
--dump x;

rmf movies
STORE movies INTO 'movies';
