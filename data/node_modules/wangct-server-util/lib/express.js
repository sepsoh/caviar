

const express = require('express');
const cookieParser = require('cookie-parser');
const bodyParser = require('body-parser');
const session = require('express-session');
const fs = require('fs');
const path = require('path');
const pathUtil = require('./path');
const serverUtil = require('./util');
const {proParse} = require('wangct-util');
const {resolve} = pathUtil;
const multer = require('multer');
const upload = multer({
  dest: resolve('temp/multer')
});

module.exports = {
  createServer,
  send,
  getReqBody
};

/**
 * 创建服务
 * @param config
 * @returns {*}
 */
function createServer(config){
  const {port,assets = [],assetsPaths = ['assets']} = config;
  const routerDirname = resolve(config.routerDirname || 'server/router');
  if(!port){
    throw new Error('port is undefined');
  }
  const app = express();
  assets.forEach(asset => {
    assetsPaths.forEach(assetsPath => {
      app.use(formatRouterPath(assetsPath),express.static(resolve(asset)));
    });
  });
  app.use(upload.any());
  app.use(cookieParser());
  app.use(bodyParser.json());
  app.use(bodyParser.urlencoded({extended: false}));
  app.use(session({
    secret:'wangct',
    name:'ssid',
    cookie:{},
    resave:false,
    saveUninitialized:true
  }));
  app.use((req,res,next) => {
    console.log('请求地址：' + req.url);
    next();
  });

  const routerList = fs.readdirSync(routerDirname);
  const apiRouter = express.Router();
  routerList.forEach(routerName => {
    const router = require(path.join(routerDirname,routerName));
    let {path:routerPath = path.basename(routerName,path.extname(routerName))} = router;
    routerPath = formatRouterPath(routerPath);
    app.use(routerPath,router);
    apiRouter.use(routerPath,router);
  });
  app.use('/api',apiRouter);
  app.use((req,res) => {
    res.sendFile(resolve(config.html || 'dist/index.html'));
  });
  app.listen(port,'0.0.0.0',() => {
    console.log(`server is started`);
    console.log(`本地地址：http://${serverUtil.getLocalIp()}:${port}`);
  });
  return app;
}


/**
 * 发送响应
 * @param res
 * @param data
 * @param err
 */
function send(res,data,err){
  if(err){
    res.send({
      code:err.code || 500,
      message:err.message || err
    })
  }else{
    proParse(data).then(data => {
      res.send({
        code:0,
        data
      })
    }).catch(err => {
      console.log(err);
      res.send({
        code:err.code || 500,
        message:err.message || err
      })
    });
  }
}

/**
 * 格式化地址
 * @param args
 * @returns {string}
 */
function formatRouterPath(...args){
  return path.join('/',...args).replace(/\\/g,'/')
}

/**
 * 获取请求的数据
 * @param req
 * @returns {Promise<*>}
 */
async function getReqBody(req){
  return new Promise((cb,eb) => {
    let buf = Buffer.alloc(0);
    req.on('data',(chunk) => {
      buf = Buffer.concat([buf,chunk]);
    });
    req.on('end',() => {
      cb(buf);
    });
    req.on('error',eb);
  })
}
