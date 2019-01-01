cloudtoken="cloudtoken"
>$cloudtoken

curl -X POST "https://keapi.qiniu.com/v1/usertoken" -d'{"name":"dcnocomment@gmail.com","password":"robot123456"}' | python parse_user.py >> $cloudtoken
echo "project_name"'\t'"robotics" >> $cloudtoken
echo "region"'\t'"xq" >> $cloudtoken
PROJECT=`awk -F'\t' '{if($1=="project_name")printf $2}' $cloudtoken`
USER_TOKEN=`awk -F'\t' '{if($1=="user_token")printf $2}' $cloudtoken`
curl "https://keapi.qiniu.com/v1/projects/${PROJECT}/token" -H "X-Auth-Token:${USER_TOKEN}" | python parse_project.py >> $cloudtoken

#awk -F'\t' '{d[FNR]=$2}END{res=d[1]; for(i=2;i<=length(d);i++){res=res "\t" d[i]}; print res}' base_info > cloudserver
#mysqlimport -r --host=localhost  --user=root --password=root --local robotics cloudserver
