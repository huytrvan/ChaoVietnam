function toLocale(event) {
    val = event.value.split(',').join('');
    val = parseInt(val).toLocaleString();
    if (val === "NaN") {
        return event.value = "";
    } else {
        return event.value = val;
    }
}