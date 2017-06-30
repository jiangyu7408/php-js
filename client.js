/**
 * Created by jiangyu on 28/06/2017.
 */
const dnode = require("dnode");

dnode.connect(7070, function(remote, conn) {
    remote.ids(function(item) {
        console.log(item);
        conn.end();
    });
});
