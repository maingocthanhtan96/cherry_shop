<template>
  <el-row>
    <el-col :span="24">
      <el-card>
        <div slot="header" class="tw-flex tw-items-center">
          <div class="tw-flex-grow tw-text-center">
            <el-badge :value="productCard.total" class="item">
              <el-button
                size="small"
                type="success"
                icon="el-icon-s-shop"
                @click="productCard.visible = true"
              ></el-button>
            </el-badge>
          </div>
          <router-link v-slot="{ href, navigate }" v-permission="['create']" :to="{ name: 'ProductCreate' }" custom>
            <a :href="href" class="pan-btn blue-btn" @click="navigate">
              <i class="el-icon-plus mr-2" />
              {{ $t('button.create') }}
            </a>
          </router-link>
        </div>
        <el-row :gutter="20" type="flex" class="tw-mb-6 tw-flex-wrap" justify="space-between">
          <el-col :xs="24" :sm="10" :md="6">
            <label>{{ $t('table.texts.filter') }}</label>
            <el-input
              v-model="table.listQuery.search"
              class="tw-w-full"
              :placeholder="$t('table.texts.filterPlaceholder')"
            />
          </el-col>
          <el-col :xs="24" :sm="14" :md="10">
            <br />
            <el-date-picker
              v-model="table.listQuery.updated_at"
              class="tw-w-full"
              type="daterange"
              :start-placeholder="$t('date.start_date')"
              :end-placeholder="$t('date.end_date')"
              :picker-options="pickerOptions"
              @change="changeDateRangePicker"
            />
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col :span="24" class="table-responsive">
            <el-table
              v-loading="table.loading"
              class="tw-w-full"
              :data="table.list"
              :default-sort="{ prop: 'updated_at', order: 'descending' }"
              border
              fit
              highlight-current-row
              @sort-change="sortChange"
            >
              <el-table-column type="expand">
                <template slot-scope="{ row }">
                  <div v-for="detail in row.product_details" :key="detail.id" class="product-detail">
                    <el-row :gutter="10" type="flex" align="middle">
                      <el-col :span="2" class="tw-text-center">
                        <el-checkbox
                          v-model="productCard.value"
                          :label="detail.id"
                          :disabled="!detail.amount"
                          @change="changeProductCard($event, detail)"
                        >
                          {{ '' }}
                        </el-checkbox>
                      </el-col>
                      <el-col :span="20" class="tw-flex tw-justify-between">
                        <p>
                          <b>{{ $t('route.size') }}</b>
                          : {{ detail.size && detail.size.name }}
                        </p>
                        <p>
                          <b>{{ $t('route.color') }}</b>
                          : {{ detail.color && detail.color.name }}
                        </p>
                        <p>
                          <b>{{ $t('table.product_detail.amount') }}</b>
                          : {{ detail.amount }}
                        </p>
                        <p>
                          <b>{{ $t('table.product_detail.price') }}</b>
                          : {{ detail.price | currency }}
                        </p>
                      </el-col>
                    </el-row>
                  </div>
                </template>
              </el-table-column>
              <el-table-column
                data-generator="code"
                prop="code"
                :label="$t('table.product.code')"
                align="left"
                header-align="center"
              >
                <template slot-scope="{ row }">
                  {{ row.code }}
                </template>
              </el-table-column>
              <el-table-column
                data-generator="name"
                prop="name"
                :label="$t('table.product.name')"
                align="left"
                header-align="center"
              >
                <template slot-scope="{ row }">
                  {{ row.name }}
                </template>
              </el-table-column>
              <el-table-column
                data-generator="image"
                prop="image"
                :label="$t('table.product.image')"
                align="left"
                header-align="center"
              >
                <template slot-scope="{ row }">
                  <el-image :src="row.image" fit="cover">
                    <div slot="error" class="image-slot">
                      <i class="el-icon-picture-outline"></i>
                    </div>
                  </el-image>
                </template>
              </el-table-column>
              <el-table-column
                data-generator="description"
                prop="description"
                :label="$t('table.product.description')"
                align="left"
                header-align="center"
              >
                <template slot-scope="{ row }">
                  {{ row.description }}
                </template>
              </el-table-column>
              <el-table-column
                data-generator="stock_in"
                prop="stock_in"
                :label="$t('table.product.stock_in')"
                align="center"
                header-align="center"
              >
                <template slot-scope="{ row }">
                  {{ row.stock_in }}
                </template>
              </el-table-column>
              <el-table-column
                data-generator="stock_out"
                prop="stock_out"
                :label="$t('table.product.stock_out')"
                align="center"
                header-align="center"
              >
                <template slot-scope="{ row }">
                  {{ row.stock_out }}
                </template>
              </el-table-column>
              <el-table-column
                data-generator="inventory"
                prop="inventory"
                :label="$t('table.product.inventory')"
                align="center"
                header-align="center"
              >
                <template slot-scope="{ row }">
                  {{ row.inventory }}
                </template>
              </el-table-column>
              <el-table-column
                data-generator="discount"
                prop="discount"
                :label="$t('table.product.discount')"
                align="center"
                header-align="center"
              >
                <template slot-scope="{ row }">
                  {{ row.discount }}
                </template>
              </el-table-column>
              <el-table-column
                data-generator="category_id"
                prop="category_id"
                :label="$t('route.category')"
                align="left"
                header-align="center"
              >
                <template v-if="row.category" slot-scope="{ row }">
                  {{ row.category.name }}
                </template>
              </el-table-column>
              <!--{{$TEMPLATES_NOT_DELETE_THIS_LINE$}}-->
              <el-table-column
                data-generator="updated_at"
                prop="updated_at"
                :label="$t('date.updated_at')"
                sortable="custom"
                align="center"
                header-align="center"
              >
                <template slot-scope="{ row }">
                  {{ row.updated_at | parseTime('{y}-{m}-{d} {h}:{i}') }}
                </template>
              </el-table-column>
              <el-table-column :label="$t('table.actions')" align="center" class-name="small-padding fixed-width">
                <template slot-scope="{ row }">
                  <!--                  <router-link v-if="row.inventory !== row.stock_in" v-permission="['edit']" :to="{ name: 'ProductSold', params: { id: row.id } }">-->
                  <!--                    <svg-icon icon-class="sold-out" class="tw-mr-2 tw-inline" />-->
                  <!--                  </router-link>-->
                  <router-link v-permission="['edit']" :to="{ name: 'ProductEdit', params: { id: row.id } }">
                    <i class="el-icon-edit el-link el-link--primary tw-mr-2" />
                  </router-link>
                  <a v-permission="['delete']" class="cursor-pointer" @click.stop="() => remove(row.id)">
                    <i class="el-icon-delete el-link el-link--danger" />
                  </a>
                </template>
              </el-table-column>
            </el-table>
            <pagination
              v-if="table.total > 0"
              :total="table.total"
              :page.sync="table.listQuery.page"
              :limit.sync="table.listQuery.limit"
              @pagination="getList"
            />
          </el-col>
        </el-row>
      </el-card>
    </el-col>
    <el-dialog
      v-loading="loading.payment"
      :title="$t('route.product')"
      :visible.sync="productCard.visible"
      width="80%"
      @close="productCard.visible = false"
    >
      <el-row v-for="detail in productCard.list" :key="detail.id" :gutter="10" class="tw-mb-6 tw-border-b-2">
        <el-col :span="4">
          <el-image :src="detail.image" style="width: 5rem; height: 5rem" fit="cover">
            <div slot="error" class="image-slot">
              <i class="el-icon-picture-outline"></i>
            </div>
          </el-image>
        </el-col>
        <el-col :span="4">
          <strong>{{ detail.name }}</strong>
          <p class="tw-text-right">{{ detail.size.name }}</p>
          <p class="tw-text-right">{{ detail.color.name }}</p>
        </el-col>
        <el-col :span="4">{{ detail.category }}</el-col>
        <el-col :span="4">{{ detail.price | currency }}</el-col>
        <el-col :span="4">
          <el-input-number v-model="detail.total" :min="1" :max="detail.amount"></el-input-number>
        </el-col>
        <el-col :span="4" class="tw-text-right">
          <el-button type="danger" icon="el-icon-delete" circle @click="onDeleteProductCard(detail.id)"></el-button>
        </el-col>
      </el-row>
      <el-row slot="footer" :gutter="10" class="dialog-footer">
        <el-col :span="12">
          <el-select
            v-model="productCard.member_id"
            name="member_id"
            filterable
            remote
            :remote-method="searchMember"
            :loading="loading.member"
            :placeholder="$t('route.member')"
            class="tw-w-full"
          >
            <el-option v-for="(item, index) in memberList" :key="'size_' + index" :label="item.name" :value="item.id">
              <div class="tw-flex tw-justify-between">
                <p>{{ item.name }}</p>
                <p class="tw-text-gray-400">{{ item.code }}</p>
              </div>
              <span style="float: left">{{ item.label }}</span>
              <span style="float: right; color: #8492a6; font-size: 13px">{{ item.value }}</span>
            </el-option>
          </el-select>
        </el-col>
        <el-col :span="4">
          <el-button type="success" icon="el-icon-plus" @click="memberVisible = true"></el-button>
        </el-col>
        <el-col :span="8">
          <el-button @click="productCard.visible = false">{{ $t('button.cancel') }}</el-button>
          <el-button type="primary" @click="storeProductPayment">{{ $t('button.confirm') }}</el-button>
        </el-col>
      </el-row>
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
          <el-button @click="memberVisible = false">{{ $t('button.cancel') }}</el-button>
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
    </el-dialog>
  </el-row>
</template>
<script>
import DateRangePicker from '@/plugins/mixins/date-range-picker';
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import { debounce } from '@/utils';
import MemberResource from '@/api/v1/member';
import ProductsResource from '@/api/v1/product';
import ProductPaymentResource from '@/api/v1/product-payment';
import { validURL } from '@/utils/validate';
import { VueMaskDirective } from 'v-mask';

const memberResource = new MemberResource();
const productResource = new ProductsResource();
const productPaymentResource = new ProductPaymentResource();

export default {
  directives: {
    mask: VueMaskDirective,
  },
  components: { Pagination },
  filters: {
    currency(string) {
      return Number(string).toLocaleString('it-IT', {
        style: 'currency',
        currency: 'VND',
      });
    },
  },
  mixins: [DateRangePicker],
  data() {
    return {
      table: {
        listQuery: {
          search: '',
          limit: 25,
          ascending: 0,
          page: 1,
          orderBy: 'updated_at',
          updated_at: [],
        },
        list: null,
        total: 0,
        loading: false,
      },
      productCard: {
        value: [],
        total: 0,
        list: [],
        visible: false,
        member_id: '',
      },
      memberForm: {
        name: '',
        sns_link: '',
        phone: '',
      },
      loading: {
        member: false,
        payment: false,
      },
      memberVisible: false,
      memberList: [],
      memberRules: {
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
      },
    };
  },
  watch: {
    'table.listQuery.search': debounce(function () {
      this.handleFilter();
    }, 500),
  },
  created() {
    this.getList();
    memberResource.productCard().then(res => {
      this.memberList = res.data.data;
    });
  },
  methods: {
    async storeProductPayment() {
      this.loading.payment = true;
      await productPaymentResource.store(this.productCard);
      this.productCard = {
        value: [],
        total: 0,
        list: [],
        visible: false,
        member_id: '',
      };
      this.productCard.visible = false;
      this.loading.payment = false;
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
    async searchMember(query) {
      if (!query) {
        this.memberList = [];
        return;
      }
      this.loading.member = true;
      const {
        data: { data: members },
      } = await memberResource.search(query);
      this.memberList = members;
      this.loading.member = false;
    },
    onDeleteProductCard(id) {
      this.deleteProductCard(id);
      this.productCard.value = this.productCard.value.filter(value => value !== id);
    },
    changeProductCard(value, detail) {
      this.productCard.total = this.productCard.value.length;
      if (value) {
        const product = this.table.list.find(item => item.id === detail.product_id);
        this.productCard.list.push({
          ...detail,
          name: product.name,
          category: product.category.name || '',
          total: 1,
          image: product.image,
          discount: product.discount,
        });
      } else {
        this.deleteProductCard(detail.id);
      }
    },
    deleteProductCard(id) {
      const index = this.productCard.list.findIndex(item => item.id === id);
      this.productCard.list.splice(index, 1);
    },
    async getList() {
      try {
        this.table.loading = true;
        const { data } = await productResource.list(this.table.listQuery);
        this.table.list = data.data;
        this.table.total = data.count;
        this.table.loading = false;
      } catch (e) {
        this.table.loading = false;
      }
    },
    handleFilter() {
      this.table.listQuery.page = 1;
      this.getList();
    },
    changeDateRangePicker(date) {
      if (date) {
        const startDate = this.parseTimeToTz(date[0]);
        const endDate = this.parseTimeToTz(date[1]);
        this.table.listQuery.updated_at = [startDate, endDate];
      } else {
        this.table.listQuery.updated_at = [];
      }
      this.handleFilter();
    },
    sortChange(data) {
      const { prop, order } = data;
      this.table.listQuery.orderBy = prop;
      this.table.listQuery.ascending = +(order === 'ascending');
      this.getList();
    },
    remove(id) {
      this.$confirm(
        this.$t('messages.delete_confirm', { attribute: this.$t('table.product.id') + '#' + id }),
        this.$t('messages.warning'),
        {
          confirmButtonText: this.$t('button.ok'),
          cancelButtonClass: this.$t('button.cancel'),
          type: 'warning',
          center: true,
        }
      ).then(async () => {
        try {
          this.table.loading = true;
          await productResource.destroy(id);
          const index = this.table.list.findIndex(value => value.id === id);
          this.table.list.splice(index, 1);
          this.$message({
            showClose: true,
            message: this.$t('messages.delete'),
            type: 'success',
          });
          this.table.loading = false;
        } catch (e) {
          this.table.loading = false;
        }
      });
    },
  },
};
</script>

<style lang="scss" scoped>
.product-detail:not(:last-child) {
  border-bottom: 1px solid;
  padding-bottom: 0.5rem;
  margin-bottom: 0.5rem;
}
</style>
