"use strict";

jQuery(function ($) {
  //Display Table for recordings
  var vczapi_wc_recordings_tbl = {
    init: function init() {
      this.cacheDOM();
      this.listeners();
    },
    cacheDOM: function cacheDOM() {
      this.$recordingsTable = $('.vczapi-woocommerce-recordings-datatable');
    },
    listeners: function listeners() {
      $(document).on('click', '.vczapi-wc-view-recording', this.viewRecordingModal.bind(this));
      $(document).on('click', '.vczapi-modal-close', this.recordingsCloseModal.bind(this));
      this.$recordingsTable.dataTable({
        ajax: {
          url: vczapi_wc_addon.ajaxurl + '?action=get_author_recordings'
        },
        columns: [{
          data: 'title'
        }, {
          data: 'start_date'
        }, {
          data: 'meeting_id'
        }, {
          data: 'total_size'
        }, {
          data: 'view_recording'
        }],
        order: [[2, "desc"]]
      });
    },
    viewRecordingModal: function viewRecordingModal(e) {
      e.preventDefault();
      var recording_id = $(e.currentTarget).data('recording-id');
      var postData = {
        recording_id: recording_id,
        action: 'get_recording',
        downlable: 1
      };
      $('.vczapi-modal').html('<p class="vczapi-modal-loader">' + vczapi_wc_addon.loading + '</p>').show();
      $.get(vczapi_wc_addon.ajaxurl, postData).done(function (response) {
        $('.vczapi-modal').html(response.data).show();
      });
    },
    recordingsCloseModal: function recordingsCloseModal(e) {
      e.preventDefault();
      $('.vczapi-modal-content').remove();
      $('.vczapi-modal').hide();
    }
  };
  vczapi_wc_recordings_tbl.init();
});