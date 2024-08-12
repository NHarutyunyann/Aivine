export default (data) => {
    let formatter = new Intl.NumberFormat('en-US', {
        style: 'decimal',
        maximumFractionDigits: 2
    });

    return formatter.format(data)
}
