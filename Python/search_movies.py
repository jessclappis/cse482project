import sys
import pandas as pd

def main():
    moviename = str(sys.argv[1])

    movies = pd.read_csv("movies.tsv", sep='\t', header=None, low_memory=False)
    movies.columns = ["movieID", "title", "releaseYear", "rating", "numVotes", "genres"]

    m = movies[movies.title.str.contains(moviename, case=False)]
    if m.shape[0] > 0:
        m = m.tail(n=25)
        mlist = m.values.tolist()
        for mov in mlist:
            print(mov[0] + "\t" + mov[1] + "\t" + mov[2])
    else:
        print('No movies found')


if __name__ == "__main__":
    main()
