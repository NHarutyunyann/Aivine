export default (str) => {
    if(typeof str !== 'string') {
        return null;
    }

    let text = str.replace(/~[^pLd]+~u/g, '').trim().replace(/~[^-\w]+~/g, '').replace(/~-+~/g, '-').toLowerCase();

    if (!text) {
        return null
    }

    return text
}
