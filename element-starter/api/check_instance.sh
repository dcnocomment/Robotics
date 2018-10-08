cloudtoken="cloudtoken"
service=$1
region=`awk -F'\t' '{if($1=="region")printf $2}' $cloudtoken`
project_name=`awk -F'\t' '{if($1=="project_name")printf $2}' $cloudtoken`
project_token=`awk -F'\t' '{if($1=="project_token")printf $2}' $cloudtoken`

curl -X GET "https://keapi.qiniu.com/regions/$region/v1/projects/$project_name/apps/robotapp/microservices/$service" -H "X-Auth-Token:$project_token"
