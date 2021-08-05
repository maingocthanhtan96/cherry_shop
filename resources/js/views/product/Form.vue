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
          <el-row :gutter="10">
            <el-col :span="12">
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
            </el-col>
            <el-col :span="12">
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
            </el-col>
          </el-row>
          <el-form-item
            data-generator="image"
            :label="$t('table.product.image')"
            prop="image"
            :error="errors.image && errors.image[0]"
          >
            <el-upload
              action="#"
              :auto-upload="false"
              list-type="picture-card"
              accept="image/png, image/jpeg, image/png"
              :file-list="formTmp.image"
              :on-change="onUploadImage"
              :on-remove="onRemoveUploadImage"
              :class="{ hidden: formTmp.image.length }"
            >
              <i class="el-icon-plus"></i>
            </el-upload>
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
          <el-row :gutter="10">
            <el-col :span="8">
              <el-form-item
                data-generator="stock_in"
                :label="$t('table.product.stock_in')"
                prop="stock_in"
                :error="errors.stock_in && errors.stock_in[0]"
              >
                <el-input-number
                  v-model="form.stock_in"
                  class="tw-w-full"
                  value=""
                  name="stock_in"
                  :placeholder="$t('table.product.stock_in')"
                />
              </el-form-item>
            </el-col>
            <el-col :span="8">
              <el-form-item
                data-generator="price"
                :label="$t('table.product.price')"
                prop="price"
                :error="errors.price && errors.price[0]"
              >
                <div class="el-input el-input--medium">
                  <money
                    v-model="form.price"
                    v-bind="money"
                    name="price"
                    :placeholder="$t('table.product.price')"
                    class="el-input__inner"
                  />
                </div>
              </el-form-item>
            </el-col>
            <el-col :span="8">
              <el-form-item
                data-generator="discount"
                :label="$t('table.product.discount')"
                prop="discount"
                :error="errors.discount && errors.discount[0]"
              >
                <el-input-number
                  v-model="form.discount"
                  name="discount"
                  :placeholder="$t('table.product.discount')"
                  class="tw-w-full"
                />
              </el-form-item>
            </el-col>
          </el-row>
          <el-row :gutter="10">
            <el-col></el-col>
          </el-row>
          <el-row :gutter="10">
            <el-col :span="8">
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
            </el-col>
            <el-col :span="8">
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
            </el-col>
            <el-col :span="8">
              <el-form-item
                data-generator="category_id"
                :label="$t('route.category')"
                prop="category_id"
                :error="errors.category_id && errors.category_id[0]"
              >
                <el-select
                  v-model="form.category_id"
                  name="category_id"
                  filterable
                  :placeholder="$t('route.category')"
                  class="tw-w-full"
                >
                  <el-option
                    v-for="(item, index) in categoryList"
                    :key="'category_' + index"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>
          </el-row>
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
import CategoryResource from '@/api/v1/category';
import { Money } from 'v-money';

// {{$IMPORT_COMPONENT_NOT_DELETE_THIS_LINE$}}

const productResource = new ProductResource();
const categoryResource = new CategoryResource();
const sizeResource = new SizeResource();
const colorResource = new ColorResource();

export default {
  components: {
    Money,
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
        stock_in: undefined,
        stock_out: '',
        inventory: '',
        price: undefined,
        discount: 0,
        status: 1,
        color_id: '',
        size_id: '',
        category_id: '',
      }, // {{$$}}
      loading: {
        form: false,
        button: false,
      },
      formTmp: {
        image: [],
      },
      formData: new FormData(),
      money: {
        decimal: ',',
        thousands: '.',
        prefix: '',
        suffix: '',
        precision: 0,
        masked: false,
      },
      colorList: [],
      sizeList: [],
      categoryList: [],
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
        stock_in: [
          {
            required: true,
            message: this.$t('validation.required', { attribute: this.$t('table.product.stock_in') }),
            trigger: ['change', 'blur'],
          },
        ],
        price: [
          {
            required: true,
            message: this.$t('validation.required', { attribute: this.$t('table.product.price') }),
            trigger: ['change', 'blur'],
          },
        ],
        category_id: [
          {
            required: true,
            message: this.$t('validation.required', { attribute: this.$t('route.category') }),
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
      const {
        data: { data: category },
      } = await categoryResource.getCategory();
      this.categoryList = category;
      // {{$CREATED_NOT_DELETE_THIS_LINE$}}
      if (id) {
        const {
          data: { data: product },
        } = await productResource.get(id);
        this.form = product;
        this.formTmp.image.push({
          url: product.image,
        });
      }
      this.loading.form = false;
    } catch (e) {
      this.loading.form = false;
    }
  },
  methods: {
    onUploadImage(file) {
      this.formTmp.image.push({ url: file.url });
      this.formData.set('image', file.raw);
    },
    onRemoveUploadImage() {
      this.formData.set('image', '');
      this.formTmp.image = [];
    },
    appendToFormData() {
      Object.keys(this.form).forEach(key => {
        if (key === 'image') {
          return;
        }
        this.formData.set(key, this.form[key]);
      });
    },
    store(product) {
      this.$refs[product].validate((valid, errors) => {
        console.log(errors, 'errors');
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
            this.appendToFormData();
            await productResource.store(this.formData);
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
            this.appendToFormData();
            this.formData.set('_method', 'PUT');
            await productResource.update(this.$route.params.id, this.formData);
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

<style lang="scss" scoped>
::v-deep {
  .hidden {
    .el-upload--picture-card {
      display: none;
    }
  }
}
</style>
