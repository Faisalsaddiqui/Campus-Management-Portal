const sweetAlert = {
    methods: {
        alert(options) {
            this.$swal(options);
        },
        alertSuccess({
            title = "Success!",
            text = "That's all done!",
            timer = 1000,
            showConfirmationButton = false
        } = {}) {
            this.alert({
                title: title,
                text: text,
                timer: timer,
                showConfirmButton: showConfirmationButton,
                type: "success"
            });
        },
        alertError({
            title = "Error!",
            text = "Oops...Something went wrong"
        } = {}) {
            this.alert({
                title: title,
                text: text,
                type: "error"
            });
        },
        confirm(callback, options) {
            options = Object.assign(
                {
                    title: "Are you sure?",
                    text: "Are you sure you want to do that?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    closeOnConfirm: false
                },
                options
            );

            this.$swal(options).then(callback);
        }
    }
};

export default sweetAlert;
