<template>
  <table class="table table-bordered plain">
    <thead>
      <th>SL no</th>
      <th>Name</th>
      <th>
        <a @click="addRow"><i class="fa fa-plus" aria-hidden="true"></i></a>
      </th>
    </thead>
    <tbody>
      <input type="hidden" name="deleted_ids" :value="deleted_ids" />
      <tr v-for="(variant, index) in all_variants" :key="index">
        <input type="hidden" name="variant_id[]" :value="variant.id" />
        <td>{{ index + 1 }}</td>
        <td>
          <input
            class="form-control"
            v-model="variant.name"
            name="variants[]"
          />
        </td>
        <td>
          <a @click="deleteRow(index)"
            ><i class="fa fa-trash" aria-hidden="true"></i
          ></a>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  props: ["variants"],
  data() {
    return {
      deletedRecords: [],
      all_variants: [],
      deleted_ids : '',
    };
  },
  mounted() {
    this.variants.map((item) => {
      this.all_variants.push({
        id: item.id,
        name: item.name,
      });
    });
  },
  methods: {
    addRow() {
      this.all_variants.push({
        id: null,
        name: "",
      });
    },
    deleteRow(index) {
      let variant = this.all_variants[index];

      if (variant.id) {
        this.deletedRecords.push(variant.id);
        this.addDeletedids();
      }

      return this.all_variants.splice(index, 1);
    },
    addDeletedids(){
        var ids = '';
        this.deletedRecords.map((item) => {
            ids += item + ',';
        });
        this.deleted_ids = ids;
    }
  },
};
</script>