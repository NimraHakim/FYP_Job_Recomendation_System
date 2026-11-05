import sys
import json
import pymysql
import pandas as pd

from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity


# ==========================================
# USER SKILLS
# ==========================================

user_skills = sys.argv[1]

if user_skills.strip() == "":
    print(json.dumps([]))
    sys.exit()


# ==========================================
# DATABASE CONNECTION
# ==========================================

connection = pymysql.connect(
    host="127.0.0.1",
    user="root",
    password="",          # <-- Agar password hai to yahan likho
    database="jobportal", # <-- Tumhara database name
    charset="utf8mb4"
)

cursor = connection.cursor()


# ==========================================
# FETCH ACTIVE JOBS
# ==========================================

query = """
SELECT
id,
title,
description,
keywords,
responsibality,
qualifications,
company_name,
location,
salary
FROM jobs
WHERE status = 1
"""

cursor.execute(query)

rows = cursor.fetchall()


# ==========================================
# DATAFRAME
# ==========================================

jobs = []

for row in rows:

    jobs.append({

        "id": row[0],
        "title": row[1] or "",
        "description": row[2] or "",
        "keywords": row[3] or "",
        "responsibility": row[4] or "",
        "qualification": row[5] or "",
        "company": row[6] or "",
        "location": row[7] or "",
        "salary": row[8] or ""

    })

df = pd.DataFrame(jobs)

if df.empty:
    print(json.dumps([]))
    sys.exit()


# ==========================================
# COMBINE TEXT
# ==========================================

df["combined"] = (

    df["title"] + " " +
    df["description"] + " " +
    df["keywords"] + " " +
    df["responsibility"] + " " +
    df["qualification"]

)


# ==========================================
# TF-IDF
# ==========================================

vectorizer = TfidfVectorizer(stop_words="english")

job_vectors = vectorizer.fit_transform(df["combined"])

user_vector = vectorizer.transform([user_skills])


# ==========================================
# SIMILARITY
# ==========================================

similarity = cosine_similarity(user_vector, job_vectors)


# ==========================================
# TOP 5 MATCHES
# ==========================================

top_indexes = similarity.argsort()[0][-5:][::-1]


# ==========================================
# RESULTS
# ==========================================

results = []

for index in top_indexes:

    score = float(similarity[0][index])

    if score > 0.2:

        results.append({

            "id": int(df.iloc[index]["id"]),
            "title": str(df.iloc[index]["title"]),
            "description": str(df.iloc[index]["description"])[:250],
            "company": str(df.iloc[index]["company"]),
            "location": str(df.iloc[index]["location"]),
            "salary": str(df.iloc[index]["salary"]),
            "score": score

        })


# ==========================================
# RETURN JSON
# ==========================================

print(json.dumps(results))

connection.close()