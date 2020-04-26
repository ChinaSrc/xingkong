http.get('http://codestudy.sinaapp.com', function (response) {});

var reqData={
 id:'111'
};
 
var post_options = {
    host: '127.0.0.1'
    port: '8888',
    path: '/api/list',
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'Content-Length': reqData.length
    }
  };
 
  var post_req = http.request(post_options, function (response) {
    var responseText=[];
    var size = 0;
    response.on('data', function (data) {
      responseText.push(data);
      size+=data.length;
    });
    response.on('end', function () {
      // Buffer 是node.js 自带的库，直接使用
      responseText = Buffer.concat(responseText,size);
      callback(responseText);
    });
  });
 
  // post the data
  post_req.write(reqData);
  post_req.end();
　　