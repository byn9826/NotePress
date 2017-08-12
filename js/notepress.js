/*global Vue listData*/

new Vue({
    el: '#app',
    data: {
        listData: listData
    }
});
console.log(listData[0].post_modified);