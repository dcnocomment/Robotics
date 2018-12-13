FROM reg.qiniu.com/robotics/ros-installed:latest
RUN rm /root/*.sh
ADD init.sh
ADD start_robot.sh
CMD ["/bin/sh" "/root/init.sh"]
