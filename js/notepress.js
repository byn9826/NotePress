/*global Vue listData*/

new Vue({
    el: '#app',
    created: function() {
        var data = {
            action: "listData",
            np_action: "read",
        };
        jQuery.ajax({
            url : "/wp-admin/admin-ajax.php",
            type: "POST",
            data: data,
            success: function( data ) {
                this.listData = JSON.parse( data );
                console.log(this.listData);
            }.bind( this )
        });
    },
    data: {
        listData: []
    }
});