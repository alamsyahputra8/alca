ding.hide();

                    KTUtil.css(listEl, 'display', 'flex'); // show list
                    KTUtil.css(viewEl, 'display', 'none'); // hide view

                    KTUtil.addClass(navItemEl, 'kt-nav__item--active');
                    KTUtil.removeClass(navItemActiveEl, 'kt-nav__item--active');

                    KTUtil.attr(listItemsEl, 'data-type', type);
                }, 600);
            });
        },

        initList: function() {
            // View message
            KTUtil.on(listEl, '.kt-inbox__item', 'click', function(e) {
                var actionsEl = KTUtil.find(this, '.kt-inbox__actions');

                // skip actions click
                if (e.target === actionsEl || (actionsEl && actionsEl.contains(e.target) === true)) {
                    return false;
                }

                // demo loading
                var loading = new KTDialog({
                    'type': 'loader',
                    'placement': 'top center',
                    'message': 'Loading ...'
                });
                loading.show();

                setTimeout(function() {
                    loading.hide();

                    KTUtil.css(listEl, 'display', 'none');
                    KTUtil.css(viewEl, 'display', 'flex');
                }, 700);
            });

            // Group selection
            KTUtil.on(listEl, '.kt-inbox__toolbar .kt-inbox__check .kt-checkbox input', 'click', function() {
                var items = KTUtil.findAll(listEl, '.kt-inbox__items .kt-inbox__item');

                for (var i = 0, j = items.length; i < j; i++) {
                    var item = items[i];
                    var checkbox = KTUtil.find(item, '.kt-inbox__actions .kt-checkbox input');
                    checkbox.checked = this.checked;

                    if (this.checked) {
                        KTUtil.addClass(item, 'kt-inbox__item--selected');
                    } else {
                        KTUtil.removeClass(item, 'kt-inbox__item--selected');
                    }
                }
            });

            // Individual selection
            KTUtil.on(listEl, '.kt-inbox__item .kt-checkbox input', 'click', function() {
                var item = this.closest('.kt-inbox__item');

                if (item && this.checked) {
                    KTUtil.addClass(item, 'kt-inbox__item--selected');
                } else {
                    KTUtil.removeClass(item, 'kt-inbox__item--selected');
                }
            });
        },

        initView: function() {
            // Back to listing
            KTUtil.on(viewEl, '.kt-inbox__toolbar .kt-inbox__icon.kt-inbox__icon--back', 'click', function() {
                // demo loading
                var loading = new KTDialog({
                    'type': 'loader',
                    'placement': 'top center',
                    'message': 'Loading ...'
                });
                loading.show();

                setTimeout(function() {
                    loading.hide();

                    KTUtil.css(listEl, 'display', 'flex');
                    KTUtil.css(viewEl, 'display', 'none');
                }, 700);
            });

            // Expand/Collapse reply
            KTUtil.on(viewEl, '.kt-inbox__messages .kt-inbox__message .kt-inbox__head', 'click', function(e) {
                var dropdownToggleEl = KTUtil.find(this, '.kt-inbox__details .kt-inbox__tome .kt-inbox__label');
                var groupActionsEl = KTUtil.find(this, '.kt-inbox__actions .kt-inbox__group');

                // skip dropdown toggle click
                if (e.target === dropdownToggleEl || (dropdownToggleEl && dropdownToggleEl.contains(e.target) === true)) {
                    return false;
                }

                // skip group actions click
                if (e.target === groupActionsEl || (groupActionsEl && groupActionsEl.contains(e.target) === true)) {
                    return false;
                }

                var message = this.closest('.kt-inbox__message');

                if (KTUtil.hasClass(message, 'kt-inbox__message--expanded')) {
                    KTUtil.removeClass(message, 'kt-inbox__message--expanded');
                } else {
                    KTUtil.addClass(message, 'kt-inbox__message--expanded');
                }
            });
        },

        initReply: function() {
            initEditor('kt_inbox_reply_editor');
            initAttachments('kt_inbox_reply_attachments');
            initForm('kt_inbox_reply_form');

            // Show/Hide reply form
            KTUtil.on(viewEl, '.kt-inbox__reply .kt-inbox__actions .btn', 'click', function(e) {
                var reply = this.closest('.kt-inbox__reply');

                if (KTUtil.hasClass(reply, 'kt-inbox__reply--on')) {
                    KTUtil.removeClass(reply, 'kt-inbox__reply--on');
                } else {
                    KTUtil.addClass(reply, 'kt-inbox__reply--on');
                }
            });

            // Show reply form for messages
            KTUtil.on(viewEl, '.kt-inbox__message .kt-inbox__actions .kt-inbox__group .kt-inbox__icon.kt-inbox__icon--reply', 'click', function(e) {
                var reply = KTUtil.find(viewEl, '.kt-inbox__reply');
                KTUtil.addClass(reply, 'kt-inbox__reply--on');
            });

            // Remove reply form
            KTUtil.on(viewEl, '.kt-inbox__reply .kt-inbox__foot .kt-inbox__icon--remove', 'click', function(e) {
                var reply = this.closest('.kt-inbox__reply');

                swal.fire({
                    text: "Are you sure to discard this reply ?",
                    //type: "error",
                    buttonsStyling: false,

                    confirmButtonText: "Discard reply",
                    confirmButtonClass: "btn btn-danger",

                    showCancelButton: true,
                    cancelButtonText: "Cancel",
                    cancelButtonClass: "btn btn-label-brand"
                }).then(function(result) {
                    if (KTUtil.hasClass(reply, 'kt-inbox__reply--on')) {
                        KTUtil.removeClass(reply, 'kt-inbox__reply--on');
                    }
                });
            });
        },

        initCompose: function() {
            initEditor('kt_inbox_compose_editor');
            initAttachments('kt_inbox_compose_attachments');
            initForm('kt_inbox_compose_form');

            // Remove reply form
            KTUtil.on(composeEl, '.kt-inbox__form .kt-inbox__foot .kt-inbox__secondary .kt-inbox__icon.kt-inbox__icon--remove', 'click', function(e) {
                swal.fire({
                    text: "Are you sure to discard this message ?",
                    type: "danger",
                    buttonsStyling: false,

                    confirmButtonText: "Discard draft",
                    confirmButtonClass: "btn btn-danger",

                    showCancelButton: true,
                    cancelButtonText: "Cancel",
                    cancelButtonClass: "btn btn-label-brand"
                }).then(function(result) {
                    $(composeEl).modal('hide');
                });
            });
        }
    };
}();

KTUtil.ready(function() {
    KTAppInbox.init();
});
