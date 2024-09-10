<template>
  <table class="table table-bordered plain">
    <thead>
      <th>SL no</th>
      <th>Select variant</th>
      <th>Name (Ex: color)</th>
      <th>Value (Ex : #fff)</th>
      <th>
        <a @click="addRow"><i class="fa fa-plus" aria-hidden="true"></i></a>
      </th>
    </thead>
    <tbody>
      <input type="hidden" name="deleted_values_ids" :value="deleted_values_ids" />
      <tr v-for="(value, index) in all_values" :key="index">
        <input type="hidden" name="value_id[]" :value="value.id" />
        <td>{{ index + 1 }}</td>
        <td>
          <select
            class="form-control"
            name="variant_ids[]"
            v-model="value.variant_id"
          >
            <option
              :value="variant.id"
              v-for="(variant, ind) in variants"
              :key="ind"
              :selected="variant.id == value.variant_id"
            >
              {{ variant.name }}
            </option>
          </select>
        </td>
        <td>
          <input class="form-control" v-model="value.name" name="names[]" />
        </td>
        <td>
          <input class="form-control" v-model="value.value" name="values[]" />
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
  props: ["variant_values", "variants"],
  data() {
    return {
      all_values: [],
      deleted_values: [],
      deleted_values_ids: "",
    };
  },
  mounted() {
    this.variant_values.map((value) => {
      this.all_values.push({
        id: value.id,
        variant_id: value.variant_id,
        name: value.name,
        value: value.value,
      });
    });
  },
  methods: {
    addRow() {
      this.all_values.push({
        id: null,
        variant_id: "",
        name: "",
        value: "",
      });
    },
    deleteRow(index) {
      let value = this.all_values[index];

      if (value.id) {
        this.deleted_values.push(value.id);
        this.addDeletedids();
      }

      return this.all_values.splice(index, 1);
    },
    addDeletedids() {
      var ids = "";
      this.deleted_values.map((item) => {
        ids += item + ",";
      });
      this.deleted_values_ids = ids;
    },
  },
};
</script>