const express = require('express');
const dnode = require("dnode");
const router = express.Router();

const cache = {};

router.get('/', function(req, res, next) {
    const itemid = req.query.id;
    if (itemid === undefined) {
        res.send({error: 'bad id'});
        return;
    }
    if (cache.hasOwnProperty(itemid)) {
        res.send(cache[itemid]);
        console.info("use cache for " + itemid);
        return;
    }
    dnode.connect(7070, function(remote, conn) {
        remote.store(itemid, function(item) {
            cache[itemid] = item;
            res.send(item);
            conn.end();
        });
    });
});

module.exports = router;
