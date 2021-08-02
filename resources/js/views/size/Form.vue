<template>
  <el-row>
    <el-col :span="24">
      <el-card>
        <div slot="header">
          <template v-if="$route.params.id">
            {{ $t('route.size_edit') }}
          </template>
          <template v-else>
            {{ $t('route.size_create') }}
          </template>
        </div>
        <el-form ref="size" v-loading="loading.form" :model="form" :rules="rules" label-position="top">
        <el-form-item
          data-generator="name"
          :label="$t('table.size.name')"
          prop="name"
          :error="errors.name && errors.name[0]"
          >
            <el-input
              v-model="form.name"
              name="name"
              :placeholder="$t('table.size.name')"
              maxlength="191"
              show-word-limit
            />
          </el-form-item>
          <el-form-item
            data-generator="product_id"
            :label="$t('route.product')"
            prop="product_id"
            :error="errors.product_id && errors.product_id[0]"
            >
	            <el-select
	              v-model="form.product_id"
	              name="product_id"
	              multiple
	              filterable
	              :placeholder="$t('route.product')"
	              class="tw-w-full"
              >
	              <el-option
	                v-for="(item, index) in productList"
	                :key="'product_' + index"
	                :label="item.name"
	                :value="item.id"
                />
	            </el-select>
            </el-form-item>
            <!--{{$FROM_ITEM_NOT_DELETE_THIS_LINE$}}-->
          <el-form-item class="tw-flex tw-justify-end">
            <router-link v-slot="{ href, navigate }" :to="{ name: 'Size' }" custom>
              <a :href="href" class="el-button el-button--info is-plain" @click="navigate">{{ $t('button.cancel') }}</a>
            </router-link>
            <template v-if="$route.params.id">
              <el-button
                :loading="loading.button"
                type="primary"
                icon="el-icon-edit"
                @click="() => update('size')"
              >
                {{ $t('button.update') }}
              </el-button>
            </template>
            <template v-else>
              <el-button
                :loading="loading.button"
                type="success"
                icon="el-icon-plus"
                @click="() => store('size')"
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
import SizeResource from '@/api/v1/size';
import ProductResource from '@/api/v1/product';
// {{$IMPORT_COMPONENT_NOT_DELETE_THIS_LINE$}}

const sizeResource = new SizeResource();
const productResource = new ProductResource();

export default {
  components: {
    // {{$IMPORT_COMPONENT_NAME_NOT_DELETE_THIS_LINE$}}
  },
  mixins: [GlobalForm],
  data() {
    return {
      form: {
          id: '',
        name: '',
        product_id: '',
 }, // {{$$}}
      loading: {
        form: false,
        button: false,
      },
      productList: [],
      // {{$DATA_NOT_DELETE_THIS_LINE$}}
    };
  },
  computed: {
    // not rename rules
    rules() {
      return {
        name: [
          { required: true, message: this.$t('validation.required', { attribute: this.$t('table.size.name') }), trigger: ['change', 'blur'] },
        ],
        // {{$RULES_NOT_DELETE_THIS_LINE$}}
      };
    },
  },
  async created() {
    try {
      this.loading.form = true;
      const { id } = this.$route.params;
      const {
        data: { data: product },
      } = await productResource.getProduct();
      this.productList = product;
// {{$CREATED_NOT_DELETE_THIS_LINE$}}
      if (id) {
        const {
          data: { data: size },
        } = await sizeResource.get(id);
        this.form = size;
      }
      this.loading.form = false;
    } catch (e) {
      this.loading.form = false;
    }
  },
  methods: {
    store(size) {
      this.$refs[size].validate((valid, errors) => {
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
            await sizeResource.store(this.form);
            this.$message({
              showClose: true,
              message: this.$t('messages.create'),
              type: 'success',
            });
            this.loading.button = false;
            await this.$router.push({ name: 'Size' });
          } catch (e) {
            this.loading.button = false;
          }
        });
      });
    },
    update(size) {
      this.$refs[size].validate((valid, errors) => {
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
            await sizeResource.update(this.$route.params.id, this.form);
            this.$message({
              showClose: true,
              message: this.$t('messages.update'),
              type: 'success',
            });
            this.loading.button = false;
            await this.$router.push({ name: 'Size' });
          } catch (e) {
            this.loading.button = false;
          }
        });
      });
    },
  },
};
</script>
