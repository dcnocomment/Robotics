echo "clean process"
ps aux | grep "node ./server.js" | grep -v grep | awk -F' ' '{print $2}' | xargs kill -9
ps aux | grep "ros" | grep -v grep | awk -F' ' '{print $2}' | xargs kill -9
ps aux | grep "gzserver" | grep -v grep | awk -F' ' '{print $2}' | xargs kill -9

echo "wait 10s for roscore launch"
roslaunch turtlebot3_gazebo turtlebot3_the_world.launch &>sim_log &
sleep 10

echo "start gzweb"
cd gzweb
npm start 80 &>gzweb_log &
cd ..
