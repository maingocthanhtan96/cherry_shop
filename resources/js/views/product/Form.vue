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
<!--            <el-col :xs="24" :span="12">-->
<!--              <el-form-item-->
<!--                data-generator="code"-->
<!--                :label="$t('table.product.code')"-->
<!--                prop="code"-->
<!--                :error="errors.code && errors.code[0]"-->
<!--              >-->
<!--                <el-input-->
<!--                  v-model="form.code"-->
<!--                  name="code"-->
<!--                  :placeholder="$t('table.product.code')"-->
<!--                  maxlength="191"-->
<!--                  show-word-limit-->
<!--                />-->
<!--              </el-form-item>-->
<!--            </el-col>-->
            <el-col :xs="24" :span="12">
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
            <el-col :xs="24" :span="14">
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
            <el-col :xs="24" :span="8">
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
          <el-row
            v-for="(detail, indexDetail) in form.product_details"
            :key="indexDetail"
            class="product-detail__list"
            :gutter="10"
          >
            <el-col :xs="24" :span="6">
              <el-form-item
                data-generator="size_id"
                :label="$t('route.size')"
                :prop="`product_details.${indexDetail}.size_id`"
                :rules="{
                  required: true,
                  message: $t('validation.required', { attribute: $t('route.size') }),
                  trigger: 'change',
                }"
                :error="errors.size_id && errors.size_id[0]"
              >
                <el-select
                  v-model="detail.size_id"
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
            </el-col>
            <el-col :xs="24" :span="6">
              <el-form-item
                data-generator="color_id"
                :label="$t('route.color')"
                :prop="`product_details.${indexDetail}.color_id`"
                :rules="{
                  required: true,
                  message: $t('validation.required', { attribute: $t('route.color') }),
                  trigger: 'change',
                }"
                :error="errors.color_id && errors.color_id[0]"
              >
                <el-select
                  v-model="detail.color_id"
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
            </el-col>
            <el-col :xs="24" :span="6">
              <el-form-item
                data-generator="amount"
                :label="$t('table.product_detail.amount')"
                :prop="`product_details.${indexDetail}.amount`"
                :rules="{
                  required: true,
                  message: $t('validation.required', { attribute: $t('table.product_detail.amount') }),
                  trigger: 'change',
                }"
                :error="errors.amount && errors.amount[0]"
              >
                <el-input-number
                  v-model="detail.amount"
                  name="amount"
                  class="tw-w-full"
                  :placeholder="$t('table.product_detail.amount')"
                />
              </el-form-item>
            </el-col>
            <el-col :xs="24" :span="6">
              <el-form-item
                data-generator="price"
                :label="$t('table.product_detail.price')"
                :prop="`product_details.${indexDetail}.price`"
                :rules="{
                  required: true,
                  message: $t('validation.required', { attribute: $t('table.product_detail.price') }),
                  trigger: 'change',
                }"
                :error="errors.price && errors.price[0]"
              >
                <div class="el-input el-input--medium">
                  <money
                    v-model="detail.price"
                    v-bind="money"
                    name="price"
                    :placeholder="$t('table.product.price')"
                    class="el-input__inner"
                  />
                </div>
              </el-form-item>
            </el-col>
            <el-button
              v-show="form.product_details.length > 1"
              type="danger"
              class="product-detail__delete"
              icon="el-icon-delete"
              @click="onRemoveProductDetail(indexDetail, detail.id)"
            ></el-button>
          </el-row>
          <el-button icon="el-icon-plus" type="primary" class="tw-mb-6" @click="onAddProductDetail">{{ $t('button.add_product_detail') }}</el-button>
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
        discount: 0,
        status: 1,
        category_id: '',
        id_deletes: [],
        product_details: [
          {
            size_id: '',
            color_id: '',
            price: '',
            amount: undefined,
          },
        ],
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
        // code: [
        //   {
        //     required: true,
        //     message: this.$t('validation.required', { attribute: this.$t('table.product.code') }),
        //     trigger: ['change', 'blur'],
        //   },
        // ],
        name: [
          {
            required: true,
            message: this.$t('validation.required', { attribute: this.$t('table.product.name') }),
            trigger: ['change', 'blur'],
          },
        ],
        // stock_in: [
        //   {
        //     required: true,
        //     message: this.$t('validation.required', { attribute: this.$t('table.product.stock_in') }),
        //     trigger: ['change', 'blur'],
        //   },
        // ],
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
    onRemoveProductDetail(index, id) {
      if (id) {
        if (!this.form.id_deletes) {
          this.form.id_deletes = [];
        }
        this.form.id_deletes.push(id);
      }
      this.form.product_details.splice(index, 1);
    },
    onAddProductDetail() {
      const lastItem = this.form.product_details[this.form.product_details.length - 1];
      this.form.product_details.push({
        size_id: '',
        color_id: '',
        price: lastItem.price || '',
        amount: undefined,
      });
    },
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
        if (key === 'product_details') {
          this.formData.set('product_details', JSON.stringify(this.form.product_details));
          return;
        }
        this.formData.set(key, this.form[key] || '');
      });
    },
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
  .product-detail__list {
    position: relative;
    .product-detail__delete {
      position: absolute;
      top: 0;
      right: 0;
      display: none;
    }
    &:hover > .product-detail__delete {
      display: block;
    }
  }
}
</style>
