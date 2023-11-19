const path = require('path');
const fs = require('fs');

const rootPath = process.cwd();

const config = {
  open: true,
  devServer: {
    server: {
      type: 'https',
      options: {
        key: fs.readFileSync('/home/edcreater/certs/device.key'),
        cert: fs.readFileSync('/home/edcreater/certs/localhost.crt'),
        //ca: fs.readFileSync("ca.crt"),
      }
    },
    host: 'localhost',
    port: '8080'
  },
  proxy: {
    enable: false,
    host: 'codesweet.local'
  },
  paths: {
    root: rootPath,
    source: path.join(rootPath, 'source'),
    bundle: path.join(rootPath, 'bundle'),
  }
};

module.exports = config;
