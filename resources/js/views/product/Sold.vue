<template>
  <el-row>
    <el-col :span="24">
      <el-card>
        <div slot="header">
          {{ $t('route.product_sold') }}
        </div>
        <el-form ref="productDetail" v-loading="loading.form" :model="form" :rules="rules" label-position="top">
          <el-row :gutter="10">
            <el-col :span="12">
              <el-form-item
                :label="$t('route.member')"
                prop="member_id"
                :error="errors.member_id && errors.member_id[0]"
              >
                <el-select
                  v-model="form.member_id"
                  name="member_id"
                  filterable
                  remote
                  :remote-method="searchMember"
                  :loading="loading.member"
                  :placeholder="$t('route.member')"
                  class="tw-w-full"
                >
                  <el-option
                    v-for="(item, index) in memberList"
                    :key="'size_' + index"
                    :label="item.name"
                    :value="item.id"
                  >
                    <div class="tw-flex tw-justify-between">
                      <p>{{ item.name }}</p>
                      <p class="tw-text-gray-400">{{ item.code }}</p>
                    </div>
                    <span style="float: left">{{ item.label }}</span>
                    <span style="float: right; color: #8492a6; font-size: 13px">{{ item.value }}</span>
                  </el-option>
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :span="12">
              <el-button
                type="success"
                icon="el-icon-plus"
                style="margin-top: 4.5rem"
                @click="memberVisible = true"
              ></el-button>
            </el-col>
          </el-row>
          <el-row :gutter="10">
            <el-col :span="6">
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
            </el-col>
            <el-col :span="6">
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
            </el-col>
            <el-col :span="6">
              <el-form-item
                data-generator="amount"
                :label="$t('table.product_detail.amount')"
                prop="amount"
                :error="errors.amount && errors.amount[0]"
              >
                <el-input-number
                  v-model="form.amount"
                  :min="1"
                  name="amount"
                  class="tw-w-full"
                  :placeholder="$t('table.product_detail.amount')"
                />
              </el-form-item>
            </el-col>
            <el-col :span="24">
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
            </el-col>
            <el-col :span="24" class="tw-flex tw-justify-end">
              <el-button
                :loading="loading.button"
                type="success"
                icon="el-icon-plus"
                @click="() => store('productDetail')"
              >
                {{ $t('button.create') }}
              </el-button>
            </el-col>
          </el-row>
        </el-form>
      </el-card>
    </el-col>
    <el-dialog :title="$t('route.member_create')" :visible.sync="memberVisible" width="50%">
      <el-form ref="member" v-loading="loading.member" :model="memberForm" :rules="memberRules" label-position="top">
        <el-row :gutter="10">
          <el-col :span="24">
            <el-form-item
              data-generator="name"
              :label="$t('table.member.name')"
              prop="name"
              :error="errors.name && errors.name[0]"
            >
              <el-input
                v-model="memberForm.name"
                name="name"
                :placeholder="$t('table.member.name')"
                maxlength="191"
                show-word-limit
              />
            </el-form-item>
          </el-col>
          <el-col :span="12">
            <el-form-item
              data-generator="sns_link"
              :label="$t('table.member.sns_link')"
              prop="sns_link"
              :error="errors.sns_link && errors.sns_link[0]"
            >
              <el-input
                v-model="memberForm.sns_link"
                name="sns_link"
                :placeholder="$t('table.member.sns_link')"
                maxlength="191"
              />
            </el-form-item>
          </el-col>
          <el-col :span="12">
            <el-form-item
              data-generator="phone"
              :label="$t('table.member.phone')"
              prop="phone"
              :error="errors.phone && errors.phone[0]"
            >
              <el-input
                v-model="memberForm.phone"
                v-mask="'####.###.###'"
                name="phone"
                :placeholder="$t('table.member.phone')"
                maxlength="191"
                show-word-limit
              />
            </el-form-item>
          </el-col>
        </el-row>
      </el-form>
      <span slot="footer" class="dialog-footer">
        <el-button @click="memberVisible = false">Cancel</el-button>
        <el-popconfirm
          :title="$t('common.popup.create')"
          :confirm-button-text="$t('button.create')"
          :cancel-button-text="$t('button.cancel')"
          @confirm="storeMember('member')"
        >
          <el-button slot="reference" type="primary">{{ $t('route.member_create') }}</el-button>
        </el-popconfirm>
      </span>
    </el-dialog>
  </el-row>
</template>

<script>
import ProductResource from '@/api/v1/product';
import MemberResource from '@/api/v1/member';
import GlobalForm from '@/plugins/mixins/global-form';
import { validURL } from '../../utils/validate';
import { VueMaskDirective } from 'v-mask';

const productResource = new ProductResource();
const memberResource = new MemberResource();

export default {
  directives: {
    mask: VueMaskDirective,
  },
  mixins: [GlobalForm],
  data() {
    return {
      loading: {
        form: false,
        button: false,
        member: false,
      },
      form: {
        color_id: '',
        size_id: '',
        member_id: '',
        amount: 1,
        total: 0,
        note: '',
      },
      memberForm: {
        name: '',
        sns_link: '',
        phone: '',
      },
      colorList: [],
      sizeList: [],
      memberList: [],
      memberVisible: false,
    };
  },
  computed: {
    rules() {
      return {
        member_id: [
          {
            required: true,
            message: this.$t('validation.required', { attribute: this.$t('route.member') }),
            trigger: ['change', 'blur'],
          },
        ],
        size_id: [
          {
            required: true,
            message: this.$t('validation.required', { attribute: this.$t('route.size') }),
            trigger: ['change', 'blur'],
          },
        ],
        color_id: [
          {
            required: true,
            message: this.$t('validation.required', { attribute: this.$t('route.color') }),
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
      };
    },
    memberRules() {
      return {
        name: [
          {
            required: true,
            message: this.$t('validation.required', { attribute: this.$t('table.member.name') }),
            trigger: ['change', 'blur'],
          },
        ],
        sns_link: [
          {
            type: 'string',
            validator: (rule, value, callback) => {
              if (!value) {
                callback();
                return;
              }
              if (validURL(value)) {
                callback();
              } else {
                callback(new Error(this.$t('validation.url', { attribute: this.$t('table.member.sns_link') })));
              }
            },
            trigger: ['change', 'blur'],
          },
        ],
      };
    },
  },
  async created() {
    try {
      this.loading.form = true;
      const {
        data: { data: productDetails },
      } = await productResource.detail(this.$route.params.id);
      this.colorList = productDetails.colors;
      this.sizeList = productDetails.sizes;
      this.loading.form = false;
    } catch (e) {
      this.loading.form = false;
    }
  },
  methods: {
    async searchMember(query) {
      if (!query) {
        this.memberList = [];
        return;
      }
      this.loading.member = true;
      const {
        data: { data: member },
      } = await memberResource.search(query);
      this.memberList = member;
      this.loading.member = false;
    },
    store(productDetail) {
      this.$refs[productDetail].validate(async (valid, errors) => {

      });
    },
    storeMember(member) {
      this.$refs[member].validate(async (valid, errors) => {
        if (this.scrollToError(valid, errors)) {
          return;
        }
        try {
          this.loading.member = true;
          const {
            data: { data: member },
          } = await memberResource.store(this.memberForm);
          this.memberList.push(member);
          this.$message({
            showClose: true,
            message: this.$t('messages.create'),
            type: 'success',
          });
          this.loading.member = false;
          this.memberVisible = false;
        } catch (e) {
          this.loading.member = false;
        }
      });
    },
  },
};
</script>
<style lang="scss"></style>
