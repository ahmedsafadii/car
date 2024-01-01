class AjaxFormManager {
    constructor(formName, postType, title="", onSuccess, onError) {
        this.form = jQuery(`form[name="${formName}"]`);
        this.postType = postType;
        this.title = title;
        this.onSuccess = onSuccess;
        this.onError = onError;
        this.initEvents();
    }

    initEvents() {
        this.form.on('submit', (e) => {
            e.preventDefault();
            this.submitForm();
        });
    }

    submitForm() {
        var formData = this.form.serializeArray();
        var data = {
            action: 'submit_form_action',
            title: this.title,
            form_submission_nonce: my_ajax_object.nonce,
            post_type: this.postType
        };

        formData.forEach(function (item) {
            data[item.name] = item.value;
        });

        jQuery.ajax({
            url: my_ajax_object.ajax_url,
            type: 'POST',
            data: data,
            success: (response) => this.handleSuccess(response),
            error: (response) => this.handleError(response)
        });
    }

    handleSuccess(response) {
        if (response.success) {
            if (this.onSuccess) {
                this.onSuccess(response);
            }
        } else {
            this.handleError(response);
        }
    }

    handleError(response) {
        if (this.onError) {
            this.onError(response);
        }
    }
}

function notifyMessage(type, message) {
    const notify = new Notyf({duration: 3000, position: {x: 'center', y: 'bottom'}});
    if (type === 'error') {
        notify.error(message);
    } else if (type === 'success') {
        notify.success(message);
    }
}