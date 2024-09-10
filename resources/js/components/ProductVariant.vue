<template>
  <div>
    <div class="row mb-4">
      <div class="col-lg-12">
        <table class="table plain">
          <thead>
            <th>Sl no</th>
            <th>Variant</th>
            <th>Values</th>
            <!-- <th>Values type</th> -->
            <th>Action</th>
          </thead>
          <tbody>
            <tr v-for="(variant, index) in variants" :key="index">
              <td>{{ index + 1 }}</td>
              <td>
                <select
                  @change="loadVariantValues(index)"
                  v-model="variants[index].variant"
                  class="form-control"
                  name="variant[]"
                >
                  <option value="">Select</option>
                  <option
                    :value="option.code"
                    v-for="option in variant_options[index]"
                    :key="option.code"
                  >
                    {{ option.label }}
                  </option>
                </select>
              </td>
              <td>
                <select
                  v-model="variants[index].variant_value"
                  class="form-control"
                  name="variant_value[]"
                >
                  <option value="">Select</option>
                  <option
                    :value="option.code"
                    v-for="option in variant_options[index].values"
                    :key="option.code"
                  >
                    {{ option.label }}
                  </option>
                </select>
                <!-- <v-select
            :options="variant_value_options"
            v-model="variants[index].variant_value"
            multiple
          ></v-select> -->
              </td>
              <td>
                <a v-if="index == 0" @click="addRow"
                  ><i class="fa fa-plus" aria-hidden="true"></i
                ></a>
                <a v-if="index != 0" @click="deleteRow(index)"
                  ><i class="fa fa-trash" aria-hidden="true"></i
                ></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div
        class="col-lg-4 variant-image-section"
        v-for="(variant, index) in variants"
        :key="index"
      >
        <div>
          <label for="">{{ getVariantImageName(index) }}</label>
          <input
            type="file"
            name="variant_image[]"
            @change="handleImageUpload($event, index)"
            :id="`variant-image-${index}`"
          />
        </div>

        <div class="preview-section" v-if="product_images_preview[index]">
          <i
            @click="removeImage(index,`variant-image-${index}`)"
            class="fa fa-times"
            aria-hidden="true"
          ></i>
          <img :src="product_images_preview[index]" alt="" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

export default {
  props: ["all_variants"],
  components: {
    vSelect,
  },
  data() {
    return {
      variants: [],
      variant_options: [],
      product_images_preview: [],
      variant_ids : [],
    };
  },
  mounted() {
    setTimeout(() => {
      this.addRow();
    }, 1000);
  },
  methods: {
    addRow() {
      var length = this.variants.push({
        variant: "",
        variant_value: "",
      });
      this.variant_options[length - 1] = [];

      this.all_variants.map((item) => {
        this.variant_options[length - 1].push({
          label: item.name,
          code: item.id,
          values: [],
        });
      });

      this.product_images_preview.push(null);
    },
    deleteRow(index) {
      this.variants.splice(index, 1);
      this.product_images_preview.splice(index, 1);
    },
    loadVariantValues(index) {
      //make empty array of variant_value_options

      //this.variant_value_options = [];
      this.variant_options[index].values = [];
      var selected_variant = this.variants[index];

      //find variant_id in all_variants
      let obj = this.all_variants.find(
        (x) => x.id === selected_variant.variant
      );
      let index_of_variant = this.all_variants.indexOf(obj);

      this.all_variants[index_of_variant].values.map((value) => {
        this.variant_options[index].values.push({
          label: value.name + " " + value.value,
          code: value.id,
        });
      });
    },

    handleImageUpload(e, index) {
      this.product_images_preview[index] = URL.createObjectURL(
        e.target.files[0]
      );
    },
    removeImage(index,image_id) {
      if (confirm("Are you sure you want to remove this?")) {
        this.product_images_preview[index] = null;
        document.getElementById(image_id).value = null;
      }
    },
    getVariantImageName(index) {
      let variant = this.variants[index];
      if (variant.variant_value != "") {
        const ind = this.all_variants.findIndex((object) => {
          return object.id === variant.variant;
        });

        const select_value_index = this.all_variants[ind].values.findIndex(
          (object) => {
            return object.id === variant.variant_value;
          }
        );
        const final_value = this.all_variants[ind].values[select_value_index];
        return final_value.name + " " + final_value.value + " image";
      }
    },
  },
};
</script>


<style scoped>
.preview-section {
  border: 1px solid #cccc;
  border-radius: 10px;
  padding: 5px 5px;
  margin-top: 10px;
  text-align: center;
  position: relative;
}
.preview-section img {
  height: 100px;
}
.preview-section i {
  position: absolute;
  right: 10px;
  font-size: 20px;
  color: red;
  cursor: pointer;
}
</style>