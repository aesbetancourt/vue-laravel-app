<template>
  <div class="container">
    <div class="card">
      <div class="large-12 medium-12 small-12 text-center card-header titulo">
        <h1>Subir Archivos</h1>
      </div>
      <div class="large-12 medium-12 small-12 filezone">
        <input type="file" id="files" ref="files" multiple v-on:change="handleFiles()" />
        <p>
          Arrasta tus archivos aqui
          <br />o haz click para buscar
        </p>
      </div>

      <div v-for="(file, key) in files" class="file-listing mt-5" v-bind:key="file">
        <img class="preview" v-bind:ref="'preview'+parseInt(key)" />
        {{ file.name }}
        <div class="success-container" v-if="file.id > 0">Exito</div>
        <div class="remove-container" v-else>
          <a class="remove" v-on:click="removeFile(key)">Remover</a>
        </div>
      </div>

      <a
        class="submit-button mb-5 boton-submit"
        v-on:click="submitFiles()"
        v-show="files.length > 0"
      >Subir</a>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      files: []
    };
  },
  methods: {
    handleFiles() {
      let uploadedFiles = this.$refs.files.files;

      for (var i = 0; i < uploadedFiles.length; i++) {
        this.files.push(uploadedFiles[i]);
      }
      this.getImagePreviews();
    },

    getImagePreviews() {
      for (let i = 0; i < this.files.length; i++) {
        if (/\.(jpe?g|png|gif)$/i.test(this.files[i].name)) {
          let reader = new FileReader();
          reader.addEventListener(
            "load",
            function() {
              this.$refs["preview" + parseInt(i)][0].src = reader.result;
            }.bind(this),
            false
          );
          reader.readAsDataURL(this.files[i]);
        } else {
          this.$nextTick(function() {
            this.$refs["preview" + parseInt(i)][0].src = "/img/generic.png";
          });
        }
      }
    },

    removeFile(key) {
      this.files.splice(key, 1);
      this.getImagePreviews();
    },

    submitFiles() {
      for (let i = 0; i < this.files.length; i++) {
        if (this.files[i].id) {
          continue;
        }
        let formData = new FormData();
        formData.append("file", this.files[i]);

        axios
          .post("/files/upload-file", formData, {
            headers: {
              "Content-Type": "multipart/form-data"
            }
          })
          .then(
            function(data) {
              this.files[i].id = data["data"]["id"];
              this.files.splice(i, 1, this.files[i]);
              console.log("success");
            }.bind(this)
          )
          .catch(function(data) {
            console.log("error");
          });
      }
    }
  }
};
</script>

<style scoped>
.boton-submit {
  cursor: pointer;
}

.titulo h1 {
  font-weight: 550;
}

input[type="file"] {
  opacity: 0;
  width: 100%;
  height: 200px;
  position: absolute;
  cursor: pointer;
}
.filezone {
  outline: 2px dashed grey;
  outline-offset: -10px;
  background: #ccc;
  color: dimgray;
  padding: 10px 10px;
  min-height: 200px;
  position: relative;
  cursor: pointer;
}
.filezone:hover {
  background: #c0c0c0;
}

.filezone p {
  font-size: 1.2em;
  text-align: center;
  padding: 50px 50px 50px 50px;
}
div.file-listing img {
  max-width: 90%;
}

div.file-listing {
  margin: auto;
  padding: 10px;
  border-bottom: 1px solid #ddd;
}

div.file-listing img {
  height: 100px;
}
div.success-container {
  text-align: center;
  color: green;
}

div.remove-container {
  text-align: center;
}

div.remove-container a {
  color: red;
  cursor: pointer;
}

a.submit-button {
  display: block;
  margin: auto;
  text-align: center;
  width: 200px;
  padding: 10px;
  text-transform: uppercase;
  background-color: #ccc;
  color: white;
  font-weight: bold;
  margin-top: 20px;
}
</style>