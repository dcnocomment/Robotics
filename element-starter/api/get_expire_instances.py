import json
import sys
import datetime
import time

for line in sys.stdin:
    line = line.strip()
    if line == "{}":
        exit(0)
    d = json.loads(line)
    for instance in d:
        name = instance["name"]
        time_str = instance["creationTime"]
        
        date_list = time_str.split("+")
        if len(date_list) != 2:
            print name
            continue
        this_time = date_list[0]
        this_ts = time.mktime(time.strptime(this_time,'%Y-%m-%dT%H:%M:%S'))
        current_ts = time.time() + 8 * 3600
        #print current_ts
        #print this_ts
        if current_ts - this_ts > 600:
            print name
