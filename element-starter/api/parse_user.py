import json
import sys

for line in sys.stdin:
    line = line.strip()
    d = json.loads(line)
    print "user_id" + '\t' + d["user"]["id"]
    print "user_token" + '\t' + d["token"]["id"]
