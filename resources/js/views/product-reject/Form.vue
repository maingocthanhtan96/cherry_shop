<template>
  <el-row>
    <el-col :span="24">
      <el-card>
        <div slot="header">
          <template v-if="$route.params.id">
            {{ $t('route.product_reject_edit') }}
          </template>
          <template v-else>
            {{ $t('route.product_reject_create') }}
          </template>
        </div>
        <el-form ref="productReject" v-loading="loading.form" :model="form" :rules="rules" label-position="top">
          <el-form-item
            data-generator="total"
            :label="$t('table.product_reject.total')"
            prop="total"
            :error="errors.total && errors.total[0]"
          >
            <el-input-number v-model="form.total" name="total" :placeholder="$t('table.product_reject.total')" />
          </el-form-item>
          <el-form-item
            data-generator="price"
            :label="$t('table.product_reject.price')"
            prop="price"
            :error="errors.price && errors.price[0]"
          >
            <el-input-number v-model="form.price" name="price" :placeholder="$t('table.product_reject.price')" />
          </el-form-item>
          <el-form-item
            data-generator="note"
            :label="$t('table.product_reject.note')"
            prop="note"
            :error="errors.note && errors.note[0]"
          >
            <el-input
              v-model="form.note"
              name="note"
              type="textarea"
              :rows="5"
              :placeholder="$t('table.product_reject.note')"
            />
          </el-form-item>
          <!--{{$FROM_ITEM_NOT_DELETE_THIS_LINE$}}-->
          <el-form-item class="tw-flex tw-justify-end">
            <router-link v-slot="{ href, navigate }" :to="{ name: 'ProductReject' }" custom>
              <a :href="href" class="el-button el-button--info is-plain" @click="navigate">{{ $t('button.cancel') }}</a>
            </router-link>
            <template v-if="$route.params.id">
              <el-button
                :loading="loading.button"
                type="primary"
                icon="el-icon-edit"
                @click="() => update('productReject')"
              >
                {{ $t('button.update') }}
              </el-button>
            </template>
            <template v-else>
              <el-button
                :loading="loading.button"
                type="success"
                icon="el-icon-plus"
                @click="() => store('productReject')"
              >
                {{ $t('button.create') }}
              </el-button>
            </template>
          </el-form-item>
        </el-form>
      </el-card>
    </el-col>
  </el-row>
</template>

<script>
import GlobalForm from '@/plugins/mixins/global-form';
import ProductRejectResource from '@/api/v1/product-reject';
// {{$IMPORT_COMPONENT_NOT_DELETE_THIS_LINE$}}

const productRejectResource = new ProductRejectResource();

export default {
  components: {
    // {{$IMPORT_COMPONENT_NAME_NOT_DELETE_THIS_LINE$}}
  },
  mixins: [GlobalForm],
  data() {
    return {
      form: {
        id: '',
        total: '',
        price: '',
        note: '',
      }, // {{$$}}
      loading: {
        form: false,
        button: false,
      },
      // {{$DATA_NOT_DELETE_THIS_LINE$}}
    };
  },
  computed: {
    // not rename rules
    rules() {
      return {
        // {{$RULES_NOT_DELETE_THIS_LINE$}}
      };
    },
  },
  async created() {
    try {
      this.loading.form = true;
      const { id } = this.$route.params;
      // {{$CREATED_NOT_DELETE_THIS_LINE$}}
      if (id) {
        const {
          data: { data: productReject },
        } = await productRejectResource.get(id);
        this.form = productReject;
      }
      this.loading.form = false;
    } catch (e) {
      this.loading.form = false;
    }
  },
  methods: {
    store(productReject) {
      this.$refs[productReject].validate((valid, errors) => {
        if (this.scrollToError(valid, errors)) {
          return;
        }
        this.$confirm(this.$t('common.popup.create'), {
          confirmButtonText: this.$t('button.create'),
          cancelButtonText: this.$t('button.cancel'),
          type: 'warning',
          center: true,
        }).then(async () => {
          try {
            this.loading.button = true;
            await productRejectResource.store(this.form);
            this.$message({
              showClose: true,
              message: this.$t('messages.create'),
              type: 'success',
            });
            this.loading.button = false;
            await this.$router.push({ name: 'ProductReject' });
          } catch (e) {
            this.loading.button = false;
          }
        });
      });
    },
    update(productReject) {
      this.$refs[productReject].validate((valid, errors) => {
        if (this.scrollToError(valid, errors)) {
          return;
        }
        this.$confirm(this.$t('common.popup.update'), {
          confirmButtonText: this.$t('button.update'),
          cancelButtonText: this.$t('button.cancel'),
          type: 'warning',
          center: true,
        }).then(async () => {
          try {
            this.loading.button = true;
            await productRejectResource.update(this.$route.params.id, this.form);
            this.$message({
              showClose: true,
              message: this.$t('messages.update'),
              type: 'success',
            });
            this.loading.button = false;
            await this.$router.push({ name: 'ProductReject' });
          } catch (e) {
            this.loading.button = false;
          }
        });
      });
    },
  },
};
</script>
