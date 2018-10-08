import json
import sys

for line in sys.stdin:
    line = line.strip()
    d = json.loads(line)
    print "project_token" + '\t' + d["token"]["id"]
