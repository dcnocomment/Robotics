sed -i 's/url : '\''ws:\/\/'\'' + this.url/url : '\''wss:\/\/'\'' + this.url + '\''\/websock'\'' + location.pathname/g' gzweb/http/client/gz3d.gui.js
sed -i 's/modelUri = '\''http:\/\/'\'' + this.url + '\''\/'\'' + modelUri;/modelUri = '\''https:\/\/'\'' + this.url + '\''\/'\'' + modelUri;/g' gzweb/http/client/gz3d.gui.js
cd gzweb; npm start 80 &
/usr/sbin/sshd -D
