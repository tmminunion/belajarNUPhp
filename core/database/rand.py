import sqlite3
from datetime import datetime, timedelta
import random

# Custom adapters and converters for datetime
def adapt_datetime(ts):
    return ts.strftime('%Y-%m-%d %H:%M:%S')

def convert_datetime(ts):
    return datetime.strptime(ts.decode('utf-8'), '%Y-%m-%d %H:%M:%S')

# Register the adapters and converters with sqlite3
sqlite3.register_adapter(datetime, adapt_datetime)
sqlite3.register_converter("TIMESTAMP", convert_datetime)

# Connect to the SQLite database (or create it if it doesn't exist)
conn = sqlite3.connect('database.sqlite', detect_types=sqlite3.PARSE_DECLTYPES)
cursor = conn.cursor()

# Generate random data for the transactions table
members = list(range(1, 21))  # Assuming member IDs are 1 to 20
types = ['kredit', 'debit']
statuses = [0, 1]  # Assuming 0 and 1 as possible statuses
payment_types = [1, 2, 3, None]  # Example payment types (1, 2, 3) and None

for _ in range(20):
    member_id = random.choice(members)
    judul = f"Item {random.randint(1, 100)}"
    jumlah = random.randint(1000, 100000)
    type_ = random.choice(types)
    status = random.choice(statuses)
    date = datetime.now() - timedelta(days=random.randint(0, 365))
    keterangan = f"Note {random.randint(1, 100)}"
    created_at = datetime.now() - timedelta(days=random.randint(0, 365))
    updated_at = datetime.now() - timedelta(days=random.randint(0, 365))
    payment_type = random.choice(payment_types)

    cursor.execute('''
    INSERT INTO transactions (member_id, judul, jumlah, type, status, date, keterangan, created_at, updated_at, payment_type)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ''', (member_id, judul, jumlah, type_, status, date, keterangan, created_at, updated_at, payment_type))

# Commit the transaction and close the connection
conn.commit()
conn.close()
