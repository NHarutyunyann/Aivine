export default (data, length = null) => {
    if(!data || typeof data !== 'string') {
        return '';
    }

    let text = '' + data;

    if(length) {
        text = text.slice(0, length)
    }

    return text + (data.length > length ? '...' : '')
}
