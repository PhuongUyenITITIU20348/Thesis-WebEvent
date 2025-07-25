import mysql.connector
import re


tag_keywords = {
    "tình nguyện": ["mùa hè xanh", "tình nguyện", "cộng đồng", "lan tỏa"],
    "học thuật": ["cuộc thi", "thi", "học thuật", "infographic", "khoa học", "trắc nghiệm"],
    "giải trí": ["camping", "dã ngoại", "vui chơi", "sinh hoạt", "trò chơi"],
    "nghệ thuật": ["âm nhạc", "trình diễn", "GC’S LIVE", "Mr & Miss", "trang phục", "sân khấu"],
    "lịch sử": ["địa chỉ đỏ", "lịch sử", "truyền thống", "cách mạng", "tưởng niệm"],
    "thể thao": ["bóng đá", "cầu lông", "bóng chuyền", "kéo co", "hội thao"],
    "kỹ năng mềm": ["kỹ năng", "teamwork", "làm việc nhóm", "thuyết trình", "tranh biện"],
    "kịch nói": ["vở kịch", "diễn", "kịch", "sân khấu", "vai diễn"]
}

# Kết nối CSDL
conn = mysql.connector.connect(
    host="localhost",
    user="root",           # Thay đổi nếu cần
    password="",           # Thay đổi nếu có mật khẩu
    database="aietclub"
)
cursor = conn.cursor(dictionary=True)

# Lấy danh sách sự kiện
cursor.execute("SELECT id, description FROM events")
events = cursor.fetchall()

# Gán tag
for event in events:
    event_id = event['id']
    desc = event['description'].lower()

    for tag, keywords in tag_keywords.items():
        if any(re.search(r'\b' + re.escape(word) + r'\b', desc) for word in keywords):
            cursor.execute("INSERT IGNORE INTO event_tags (event_id, tag) VALUES (%s, %s)", (event_id, tag))

# Lưu thay đổi
conn.commit()
cursor.close()
conn.close()
print("✅ Gán tag tự động hoàn tất!")
