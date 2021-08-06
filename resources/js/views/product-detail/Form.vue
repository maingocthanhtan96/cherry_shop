<template>
  <el-row>
    <el-col :span="24">
      <el-card>
        <div slot="header">
          <template v-if="$route.params.id">
            {{ $t('route.product_detail_edit') }}
          </template>
          <template v-else>
            {{ $t('route.product_detail_create') }}
          </template>
        </div>
        <el-form ref="productDetail" v-loading="loading.form" :model="form" :rules="rules" label-position="top">
          <el-form-item
            data-generator="price"
            :label="$t('table.product_detail.price')"
            prop="price"
            :error="errors.price && errors.price[0]"
          >
            <el-input
              v-model="form.price"
              name="price"
              :placeholder="$t('table.product_detail.price')"
              maxlength="191"
              show-word-limit
            />
          </el-form-item>
          <el-form-item
            data-generator="amount"
            :label="$t('table.product_detail.amount')"
            prop="amount"
            :error="errors.amount && errors.amount[0]"
          >
            <el-input-number v-model="form.amount" name="amount" :placeholder="$t('table.product_detail.amount')" />
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
            <el-form-item
          data-generator="size_id"
          :label="$t('route.size')"
          prop="size_id"
          :error="errors.size_id && errors.size_id[0]"
          >
            <el-select
              v-model="form.size_id"
              name="size_id"
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
            <el-form-item
          data-generator="color_id"
          :label="$t('route.color')"
          prop="color_id"
          :error="errors.color_id && errors.color_id[0]"
          >
            <el-select
              v-model="form.color_id"
              name="color_id"
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
            <!--{{$FROM_ITEM_NOT_DELETE_THIS_LINE$}}-->
          <el-form-item class="tw-flex tw-justify-end">
            <router-link v-slot="{ href, navigate }" :to="{ name: 'ProductDetail' }" custom>
              <a :href="href" class="el-button el-button--info is-plain" @click="navigate">{{ $t('button.cancel') }}</a>
            </router-link>
            <template v-if="$route.params.id">
              <el-button
                :loading="loading.button"
                type="primary"
                icon="el-icon-edit"
                @click="() => update('productDetail')"
              >
                {{ $t('button.update') }}
              </el-button>
            </template>
            <template v-else>
              <el-button
                :loading="loading.button"
                type="success"
                icon="el-icon-plus"
                @click="() => store('productDetail')"
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
import ProductDetailResource from '@/api/v1/product-detail';
import ProductResource from '@/api/v1/product';
import SizeResource from '@/api/v1/size';
import ColorResource from '@/api/v1/color';
// {{$IMPORT_COMPONENT_NOT_DELETE_THIS_LINE$}}

const productDetailResource = new ProductDetailResource();
const colorResource = new ColorResource();
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
        price: '',
        amount: '',
        product_id: '',
        size_id: '',
        color_id: '',
 }, // {{$$}}
      loading: {
        form: false,
        button: false,
      },
      productList: [],
      sizeList: [],
      colorList: [],
      // {{$DATA_NOT_DELETE_THIS_LINE$}}
    };
  },
  computed: {
    // not rename rules
    rules() {
      return {
        price: [
          {
            required: true,
            message: this.$t('validation.required', { attribute: this.$t('table.product_detail.price') }),
            trigger: ['change', 'blur'],
          },
        ],
        amount: [
          {
            required: true,
            message: this.$t('validation.required', { attribute: this.$t('table.product_detail.amount') }),
            trigger: ['change', 'blur'],
          },
        ],
        product_id: [
          { required: true, message: this.$t('validation.required', { attribute: this.$t('route.product_detail') }), trigger: ['change', 'blur'] },
        ],
        size_id: [
          { required: true, message: this.$t('validation.required', { attribute: this.$t('route.product_detail') }), trigger: ['change', 'blur'] },
        ],
        color_id: [
          { required: true, message: this.$t('validation.required', { attribute: this.$t('route.product_detail') }), trigger: ['change', 'blur'] },
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
const {
        data: { data: size },
      } = await sizeResource.getSize();
      this.sizeList = size;
const {
        data: { data: color },
      } = await colorResource.getColor();
      this.colorList = color;
// {{$CREATED_NOT_DELETE_THIS_LINE$}}
      if (id) {
        const {
          data: { data: productDetail },
        } = await productDetailResource.get(id);
        this.form = productDetail;
      }
      this.loading.form = false;
    } catch (e) {
      this.loading.form = false;
    }
  },
  methods: {
    store(productDetail) {
      this.$refs[productDetail].validate((valid, errors) => {
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
            await productDetailResource.store(this.form);
            this.$message({
              showClose: true,
              message: this.$t('messages.create'),
              type: 'success',
            });
            this.loading.button = false;
            await this.$router.push({ name: 'ProductDetail' });
          } catch (e) {
            this.loading.button = false;
          }
        });
      });
    },
    update(productDetail) {
      this.$refs[productDetail].validate((valid, errors) => {
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
            await productDetailResource.update(this.$route.params.id, this.form);
            this.$message({
              showClose: true,
              message: this.$t('messages.update'),
              type: 'success',
            });
            this.loading.button = false;
            await this.$router.push({ name: 'ProductDetail' });
          } catch (e) {
            this.loading.button = false;
          }
        });
      });
    },
  },
};
</script>
