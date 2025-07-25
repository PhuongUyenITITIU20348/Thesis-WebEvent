import pandas as pd
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
import numpy as np
import json

# Load CSV
df_members = pd.read_csv("members.csv")
df_events = pd.read_csv("events (1).csv")
df_member_event = pd.read_csv("member_event.csv")

# TF-IDF
vectorizer = TfidfVectorizer(stop_words='english')
event_tfidf_matrix = vectorizer.fit_transform(df_events['description'].fillna(''))

event_id_to_index = {eid: idx for idx, eid in enumerate(df_events['id'])}
index_to_event_id = {idx: eid for eid, idx in event_id_to_index.items()}

recommendations = {}

for member_id in df_members['member_id']:
    joined_events = df_member_event[df_member_event['member_id'] == member_id]['event_id'].tolist()
    joined_indices = [event_id_to_index[eid] for eid in joined_events if eid in event_id_to_index]

    if not joined_indices:
        continue

        if not joined_indices:
            continue

 
    user_profile = np.asarray(np.mean(event_tfidf_matrix[joined_indices], axis=0)).reshape(1, -1)
    
    similarities = cosine_similarity(user_profile, event_tfidf_matrix).flatten()

    for idx in joined_indices:
        similarities[idx] = -1

    top_indices = similarities.argsort()[-3:][::-1]
    top_event_ids = [index_to_event_id[idx] for idx in top_indices]
    recommendations[member_id] = top_event_ids

with open("recommendations.json", "w") as f:
    json.dump(recommendations, f, indent=2)
