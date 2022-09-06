import moment from "moment";

export function useFormatDate() {
    function formatDate(value) {
        if (value) {
            let timestamp = moment(String(value)).format('DD.MM.YYYY');

            if (moment(timestamp).fromNow().includes('years')) {
                return 'Posted on ' + timestamp;
            }
            return 'Posted ' + moment(value).fromNow();
        }
    }

    return {formatDate};
}
