export default (errors, dispatch, noteConfigs = {}) => {
    const errs = {}
    if (errors.response && errors.response.status === 422 && errors.response.data) {

        for (const item in errors.response.data.errors) {
            errs[item] = errors.response.data.errors[item][0]
        }
    }

    if (errors.response && errors.response.status === 500 && errors.response.data) {
        if(errors.response.data.message) {
            dispatch('addNote', {...{item: {message: errors.response.data.message, type: 'error'}}, ...noteConfigs})
        } else if(errors.response.data.messages) {
            for(let i = 0; i < errors.response.data.messages.length; i++) {
                dispatch('addNote', {...{item: {message: errors.response.data.messages[i], type: 'error'}}, ...noteConfigs})
            }
        }
    }

    return [errors, {validation_errors: errs}]
}
