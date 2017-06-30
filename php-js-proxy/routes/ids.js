const express = require('express');
const dnode = require("dnode");
const router = express.Router();

router.get('/', function(req, res, next) {
    dnode.connect(7070, function(remote, conn) {
        remote.ids(function(idList) {
            res.send(idList);
            conn.end();
        });
    });
});

module.exports = router;
