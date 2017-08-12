/*global Vue*/

Vue.mixin({
    methods: {
        dateChecker: function ( orig ) {
            var past = Date.now() - Date.parse( orig );
            var base;
            if ( past >= 0 && past <= 1000 * 60 ) {
                return "Just Now";
            } else if ( past > 1000 * 60 && past <= 1000 * 60 * 60 ) {
                base = parseInt( past / 1000 / 60 );
                if ( base === 1 ) {
                    return "1 MINUTE AGO";
                } else {
                    return base + " MINUTES AGO";
                }
            } else if ( past > 1000 * 60 * 60 && past <= 1000 * 60 * 60 * 24 ) {
                base = parseInt( past / 1000 / 60 / 60 );
                if ( base === 1 ) {
                    return "1 HOUR AGO";
                } else {
                    return base + " HOURS AGO";
                }
            } else if ( past > 1000 * 60 * 60 * 24 && past <= 1000 * 60 * 60 * 24 * 7 ) {
                base = parseInt( past / 1000 / 60 / 60 /24 );
                if ( base === 1 ) {
                    return "1 DAY AGO";
                } else {
                    return base + " DAYS AGO";
                }
            } else if ( past > 1000 * 60 * 60 * 24 * 7 && past <= 1000 * 60 * 60 * 24 * 7 * 4 ) {
                base = parseInt( past / 1000 / 60 / 60 /24 / 7 );
                if ( base === 1 ) {
                    return "1 WEEK AGO";
                } else {
                    return base + " WEEKS AGO";
                }
            } else {
                return orig.substr( 0, 10 );
            }
        }
    }
});