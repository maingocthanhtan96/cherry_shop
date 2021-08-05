<template>
  <el-row>
    <el-col :span="24">
      <el-card>
        <div slot="header">
          <template v-if="$route.params.id">
            {{ $t('route.product_payment_edit') }}
          </template>
          <template v-else>
            {{ $t('route.product_payment_create') }}
          </template>
        </div>
        <el-form ref="productPayment" v-loading="loading.form" :model="form" :rules="rules" label-position="top">
          <el-form-item
            data-generator="total"
            :label="$t('table.product_payment.total')"
            prop="total"
            :error="errors.total && errors.total[0]"
          >
            <el-input-number v-model="form.total" name="total" :placeholder="$t('table.product_payment.total')" />
          </el-form-item>
          <el-form-item
            data-generator="price"
            :label="$t('table.product_payment.price')"
            prop="price"
            :error="errors.price && errors.price[0]"
          >
            <el-input-number v-model="form.price" name="price" :placeholder="$t('table.product_payment.price')" />
          </el-form-item>
          <el-form-item
            data-generator="note"
            :label="$t('table.product_payment.note')"
            prop="note"
            :error="errors.note && errors.note[0]"
          >
            <el-input
              v-model="form.note"
              name="note"
              type="textarea"
              :rows="5"
              :placeholder="$t('table.product_payment.note')"
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
            <el-form-item
          data-generator="member_id"
          :label="$t('route.member')"
          prop="member_id"
          :error="errors.member_id && errors.member_id[0]"
          >
            <el-select
              v-model="form.member_id"
              name="member_id"
              filterable
              :placeholder="$t('route.member')"
              class="tw-w-full"
            >
              <el-option
                v-for="(item, index) in memberList"
                :key="'member_' + index"
                :label="item.name"
                :value="item.id"
              />
            </el-select>
          </el-form-item>
            <!--{{$FROM_ITEM_NOT_DELETE_THIS_LINE$}}-->
          <el-form-item class="tw-flex tw-justify-end">
            <router-link v-slot="{ href, navigate }" :to="{ name: 'ProductPayment' }" custom>
              <a :href="href" class="el-button el-button--info is-plain" @click="navigate">{{ $t('button.cancel') }}</a>
            </router-link>
            <template v-if="$route.params.id">
              <el-button
                :loading="loading.button"
                type="primary"
                icon="el-icon-edit"
                @click="() => update('productPayment')"
              >
                {{ $t('button.update') }}
              </el-button>
            </template>
            <template v-else>
              <el-button
                :loading="loading.button"
                type="success"
                icon="el-icon-plus"
                @click="() => store('productPayment')"
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
import ProductPaymentResource from '@/api/v1/product-payment';
import ProductResource from '@/api/v1/product';
import SizeResource from '@/api/v1/size';
import ColorResource from '@/api/v1/color';
import MemberResource from '@/api/v1/member';
// {{$IMPORT_COMPONENT_NOT_DELETE_THIS_LINE$}}

const productPaymentResource = new ProductPaymentResource();
const memberResource = new MemberResource();
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
        total: 0,
        price: '',
        note: '',
        product_id: '',
        size_id: '',
        color_id: '',
        member_id: '',
 }, // {{$$}}
      loading: {
        form: false,
        button: false,
      },
      productList: [],
      sizeList: [],
      colorList: [],
      memberList: [],
      // {{$DATA_NOT_DELETE_THIS_LINE$}}
    };
  },
  computed: {
    // not rename rules
    rules() {
      return {
        product_id: [
          {
            required: true,
            message: this.$t('validation.required', { attribute: this.$t('route.product_payment') }),
            trigger: ['change', 'blur'],
          },
        ],
        size_id: [
          { required: true, message: this.$t('validation.required', { attribute: this.$t('route.product_payment') }), trigger: ['change', 'blur'] },
        ],
        color_id: [
          { required: true, message: this.$t('validation.required', { attribute: this.$t('route.product_payment') }), trigger: ['change', 'blur'] },
        ],
        member_id: [
          { required: true, message: this.$t('validation.required', { attribute: this.$t('route.product_payment') }), trigger: ['change', 'blur'] },
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
const {
        data: { data: member },
      } = await memberResource.getMember();
      this.memberList = member;
// {{$CREATED_NOT_DELETE_THIS_LINE$}}
      if (id) {
        const {
          data: { data: productPayment },
        } = await productPaymentResource.get(id);
        this.form = productPayment;
      }
      this.loading.form = false;
    } catch (e) {
      this.loading.form = false;
    }
  },
  methods: {
    store(productPayment) {
      this.$refs[productPayment].validate((valid, errors) => {
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
            await productPaymentResource.store(this.form);
            this.$message({
              showClose: true,
              message: this.$t('messages.create'),
              type: 'success',
            });
            this.loading.button = false;
            await this.$router.push({ name: 'ProductPayment' });
          } catch (e) {
            this.loading.button = false;
          }
        });
      });
    },
    update(productPayment) {
      this.$refs[productPayment].validate((valid, errors) => {
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
            await productPaymentResource.update(this.$route.params.id, this.form);
            this.$message({
              showClose: true,
              message: this.$t('messages.update'),
              type: 'success',
            });
            this.loading.button = false;
            await this.$router.push({ name: 'ProductPayment' });
          } catch (e) {
            this.loading.button = false;
          }
        });
      });
    },
  },
};
</script>
