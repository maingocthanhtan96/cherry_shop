<template>
  <el-row>
    <el-col :span="24">
      <el-card>
        <div slot="header">
          <template v-if="$route.params.id">
            {{ $t('route.product_edit') }}
          </template>
          <template v-else>
            {{ $t('route.product_create') }}
          </template>
        </div>
        <el-form ref="product" v-loading="loading.form" :model="form" :rules="rules" label-position="top">
          <el-form-item
            data-generator="code"
            :label="$t('table.product.code')"
            prop="code"
            :error="errors.code && errors.code[0]"
          >
            <el-input
              v-model="form.code"
              name="code"
              :placeholder="$t('table.product.code')"
              maxlength="191"
              show-word-limit
            />
          </el-form-item>
          <el-form-item
            data-generator="name"
            :label="$t('table.product.name')"
            prop="name"
            :error="errors.name && errors.name[0]"
          >
            <el-input
              v-model="form.name"
              name="name"
              :placeholder="$t('table.product.name')"
              maxlength="191"
              show-word-limit
            />
          </el-form-item>
          <el-form-item
            data-generator="image"
            :label="$t('table.product.image')"
            prop="image"
            :error="errors.image && errors.image[0]"
          >
            <el-input
              v-model="form.image"
              name="image"
              :placeholder="$t('table.product.image')"
              maxlength="191"
              show-word-limit
            />
          </el-form-item>
          <el-form-item
            data-generator="description"
            :label="$t('table.product.description')"
            prop="description"
            :error="errors.description && errors.description[0]"
          >
            <el-input
              v-model="form.description"
              name="description"
              type="textarea"
              :rows="5"
              :placeholder="$t('table.product.description')"
            />
          </el-form-item>
          <el-form-item
            data-generator="stock_in"
            :label="$t('table.product.stock_in')"
            prop="stock_in"
            :error="errors.stock_in && errors.stock_in[0]"
          >
            <el-input-number v-model="form.stock_in" name="stock_in" :placeholder="$t('table.product.stock_in')" />
          </el-form-item>
          <el-form-item
            data-generator="stock_out"
            :label="$t('table.product.stock_out')"
            prop="stock_out"
            :error="errors.stock_out && errors.stock_out[0]"
          >
            <el-input-number v-model="form.stock_out" name="stock_out" :placeholder="$t('table.product.stock_out')" />
          </el-form-item>
          <el-form-item
            data-generator="inventory"
            :label="$t('table.product.inventory')"
            prop="inventory"
            :error="errors.inventory && errors.inventory[0]"
          >
            <el-input-number v-model="form.inventory" name="inventory" :placeholder="$t('table.product.inventory')" />
          </el-form-item>
          <el-form-item
            data-generator="price"
            :label="$t('table.product.price')"
            prop="price"
            :error="errors.price && errors.price[0]"
          >
            <el-input-number v-model="form.price" name="price" :placeholder="$t('table.product.price')" />
          </el-form-item>
          <el-form-item
            data-generator="discount"
            :label="$t('table.product.discount')"
            prop="discount"
            :error="errors.discount && errors.discount[0]"
          >
            <el-input-number v-model="form.discount" name="discount" :placeholder="$t('table.product.discount')" />
          </el-form-item>
          <el-form-item
            data-generator="status"
            :label="$t('table.product.status')"
            prop="status"
            :error="errors.status && errors.status[0]"
          >
            <el-tooltip :content="form.status === 0 ? 'OFF' : 'ON'" placement="top">
              <el-switch v-model="form.status" name="status" :active-value="1" :inactive-value="0" />
            </el-tooltip>
          </el-form-item>
          <el-form-item
            data-generator="color_id"
            :label="$t('route.color')"
            prop="color_id"
            :error="errors.color_id && errors.color_id[0]"
          >
            <el-select
              v-model="form.color_id"
              name="color_id"
              multiple
              filterable
              :placeholder="$t('route.color')"
              class="tw-w-full"
            >
              <el-option
                v-for="(item, index) in colorList"
                :key="'color_' + index"
                :label="item.name"
                :value="item.id"
              />
            </el-select>
          </el-form-item>
          <el-form-item
            data-generator="size_id"
            :label="$t('route.size')"
            prop="size_id"
            :error="errors.size_id && errors.size_id[0]"
            >
	            <el-select
	              v-model="form.size_id"
	              name="size_id"
	              multiple
	              filterable
	              :placeholder="$t('route.size')"
	              class="tw-w-full"
              >
	              <el-option
	                v-for="(item, index) in sizeList"
	                :key="'size_' + index"
	                :label="item.name"
	                :value="item.id"
                />
	            </el-select>
            </el-form-item>
            <!--{{$FROM_ITEM_NOT_DELETE_THIS_LINE$}}-->
          <el-form-item class="tw-flex tw-justify-end">
            <router-link v-slot="{ href, navigate }" :to="{ name: 'Product' }" custom>
              <a :href="href" class="el-button el-button--info is-plain" @click="navigate">{{ $t('button.cancel') }}</a>
            </router-link>
            <template v-if="$route.params.id">
              <el-button :loading="loading.button" type="primary" icon="el-icon-edit" @click="() => update('product')">
                {{ $t('button.update') }}
              </el-button>
            </template>
            <template v-else>
              <el-button :loading="loading.button" type="success" icon="el-icon-plus" @click="() => store('product')">
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
import ProductResource from '@/api/v1/product';
import ColorResource from '@/api/v1/color';
import SizeResource from '@/api/v1/size';
// {{$IMPORT_COMPONENT_NOT_DELETE_THIS_LINE$}}

const productResource = new ProductResource();
const sizeResource = new SizeResource();
const colorResource = new ColorResource();

export default {
  components: {
    // {{$IMPORT_COMPONENT_NAME_NOT_DELETE_THIS_LINE$}}
  },
  mixins: [GlobalForm],
  data() {
    return {
      form: {
          id: '',
        code: '',
        name: '',
        image: '',
        description: '',
        stock_in: '',
        stock_out: '',
        inventory: '',
        price: '',
        discount: '',
        status: 1,
        color_id: '',
        size_id: '',
 }, // {{$$}}
      loading: {
        form: false,
        button: false,
      },
      colorList: [],
      sizeList: [],
      // {{$DATA_NOT_DELETE_THIS_LINE$}}
    };
  },
  computed: {
    // not rename rules
    rules() {
      return {
        code: [
          {
            required: true,
            message: this.$t('validation.required', { attribute: this.$t('table.product.code') }),
            trigger: ['change', 'blur'],
          },
        ],
        name: [
          {
            required: true,
            message: this.$t('validation.required', { attribute: this.$t('table.product.name') }),
            trigger: ['change', 'blur'],
          },
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
        data: { data: color },
      } = await colorResource.getColor();
      this.colorList = color;
      const {
        data: { data: size },
      } = await sizeResource.getSize();
      this.sizeList = size;
// {{$CREATED_NOT_DELETE_THIS_LINE$}}
      if (id) {
        const {
          data: { data: product },
        } = await productResource.get(id);
        this.form = product;
      }
      this.loading.form = false;
    } catch (e) {
      this.loading.form = false;
    }
  },
  methods: {
    store(product) {
      this.$refs[product].validate((valid, errors) => {
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
            await productResource.store(this.form);
            this.$message({
              showClose: true,
              message: this.$t('messages.create'),
              type: 'success',
            });
            this.loading.button = false;
            await this.$router.push({ name: 'Product' });
          } catch (e) {
            this.loading.button = false;
          }
        });
      });
    },
    update(product) {
      this.$refs[product].validate((valid, errors) => {
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
            await productResource.update(this.$route.params.id, this.form);
            this.$message({
              showClose: true,
              message: this.$t('messages.update'),
              type: 'success',
            });
            this.loading.button = false;
            await this.$router.push({ name: 'Product' });
          } catch (e) {
            this.loading.button = false;
          }
        });
      });
    },
  },
};
</script>
