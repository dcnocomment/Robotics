import json
import sys
uuid = sys.argv[1]

res = {}
res["name"] = uuid
res["type"] = "stateless"
res["resourceSpec"] = "2U4G"
res["instanceNumber"] = 1
res["ports"] = [
    {"port":80, "protocol":"TCP"}, 
    {"port":22, "protocol":"TCP"}
]
res["containers"] = [
{
    "name": "container-0" + "-" + uuid, 
    "image": "reg.qiniu.com/robotics/ros-installed:latest", 
    "workingDir": "/root", 
    "command": ["/bin/sh"],
    "args": ["init_ros.sh"],
    "volumeMounts": [],
    "configs": [],
    "envs": [{"name": "PATH", "value": "/opt/ros/kinetic/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games:/usr/local/games"},{"name": "PYTHONPATH", "value": "/opt/ros/kinetic/lib/python2.7/dist-packages:/root/catkin_ws/devel/lib/python2.7/dist-packages"}]
}]
print json.dumps(res)
