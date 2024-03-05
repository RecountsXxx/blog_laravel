<template>
  <div class="modal"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog w-25" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New message to users</h5>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Message:</label>
              <textarea v-model="newItemText" class="form-control" id="message-text"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button"  @click="closeModal" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" @click="addItem" class="btn btn-primary">Send message</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import socket from "@/services/Socket/SocketService.js";

export default {
  name: 'ModalForm',
  data() {
    return {
      newItemText: ''
    };
  },
  methods: {
    closeModal() {
      this.$emit('close');
    },
    addItem() {
      if (this.newItemText.trim() !== '') {
        this.$emit('add', { text: this.newItemText });
        console.log('input text: ' + this.newItemText);
        this.$notify("Message sended");
        socket.emit('socket.message.admin', this.newItemText);
        this.newItemText = '';
        this.closeModal();
      }
    }
  }
};
</script>

<style>
.modal {
  display: flex;
  justify-content: center;
  align-items: center;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

.close {
  float: right;
  cursor: pointer;
}

textarea {
  width: 100%;
  margin-bottom: 10px;
  resize: vertical;
}

button {
  padding: 5px 10px;
}
</style>
