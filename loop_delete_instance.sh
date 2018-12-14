cd element-starter/api/
for i in `sh get_instances.sh | python get_expire_instances.py`; do 
sh delete_instance.sh $i; 
done
