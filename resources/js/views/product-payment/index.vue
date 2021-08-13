<template>
  <el-row>
    <el-col :span="24">
      <el-card>
        <el-row :gutter="10" class="panel-group">
          <el-col :xs="12" :sm="12" :lg="6" class="card-panel-col">
            <div class="card-panel">
              <div class="card-panel-icon-wrapper icon-people">
                <svg-icon icon-class="money" class-name="card-panel-icon" />
              </div>
              <div class="card-panel-description">
                <div class="card-panel-text">{{ $t('table.product_payment.total_sold') }}</div>
                <count-to :start-val="0" :end-val="totalSold" :duration="2600" class="card-panel-num" />
              </div>
            </div>
          </el-col>
        </el-row>
        <el-row :gutter="20" class="tw-mb-6" type="flex" justify="end">
          <el-col :xs="24" :sm="14" :md="18">
            <el-date-picker
              v-model="table.listQuery.updated_at"
              class="md:tw-float-right"
              type="daterange"
              :start-placeholder="$t('date.start_date')"
              :end-placeholder="$t('date.end_date')"
              :picker-options="pickerOptions"
              @change="changeDateRangePicker"
            />
          </el-col>
        </el-row>
        <el-row :gutter="10">
          <el-col v-loading="chart.loading" :span="24">
            <line-chart :chart-data="chart.data" />
          </el-col>
        </el-row>
        <el-row :gutter="10" type="flex" align="center" justify="space-between" class="tw-mb-6">
          <el-col :xs="24" :sm="10" :md="12">
            <label>{{ $t('table.texts.filter') }}</label>
            <el-input v-model="table.listQuery.search" :placeholder="$t('table.texts.filterPlaceholder')" />
          </el-col>
          <el-col :xs="24" :sm="12" :md="6" class="excel tw-text-right">
            <el-button type="success" icon="el-icon-download" :loading="excel.downloadLoading" @click="onExcel">
              Excel
            </el-button>
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
              <el-table-column
                align="center"
                sortable="custom"
                prop="id"
                :label="$t('table.product_payment.id')"
                width="70px"
              >
                <template slot-scope="{ row }">
                  {{ row.id }}
                </template>
              </el-table-column>
              <el-table-column
                data-generator="total"
                prop="total"
                :label="$t('table.product_payment.total')"
                align="center"
                header-align="center"
              >
                <template slot-scope="{ row }">
                  {{ row.total }}
                </template>
              </el-table-column>
              <el-table-column
                data-generator="price"
                prop="price"
                :label="$t('table.product_payment.price')"
                align="center"
                header-align="center"
                min-width="110px"
              >
                <template slot-scope="{ row }">
                  {{ row.price | currency }}
                </template>
              </el-table-column>
              <el-table-column
                data-generator="note"
                prop="note"
                :label="$t('table.product_payment.note')"
                align="left"
                header-align="center"
              >
                <template slot-scope="{ row }">
                  {{ row.note }}
                </template>
              </el-table-column>
              <el-table-column
                data-generator="product_id"
                prop="product_id"
                :label="$t('route.product')"
                align="left"
                header-align="center"
              >
                <template v-if="row.product" slot-scope="{ row }">
                  {{ row.product.name }}
                </template>
              </el-table-column>
              <el-table-column
                data-generator="size_id"
                prop="size_id"
                :label="$t('route.size')"
                align="left"
                header-align="center"
              >
                <template v-if="row.size" slot-scope="{ row }">
                  {{ row.size.name }}
                </template>
              </el-table-column>
              <el-table-column
                data-generator="color_id"
                prop="color_id"
                :label="$t('route.color')"
                align="left"
                header-align="center"
              >
                <template v-if="row.color" slot-scope="{ row }">
                  {{ row.color.name }}
                </template>
              </el-table-column>
              <el-table-column
                data-generator="member_id"
                prop="member_id"
                :label="$t('route.member')"
                align="left"
                header-align="center"
              >
                <template v-if="row.member" slot-scope="{ row }">
                  {{ row.member.name }}
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
              <el-table-column :label="$t('table.actions')" align="center">
                <template slot-scope="{ row }">
                  <svg-icon
                    v-permission="['edit']"
                    icon-class="rollback"
                    class="tw-text-2xl tw-m-auto tw-cursor-pointer"
                    @click="onRollback(row)"
                  />
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
  </el-row>
</template>
<script>
import DateRangePicker from '@/plugins/mixins/date-range-picker';
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import { debounce } from '@/utils';
import countTo from 'vue-count-to';
import LineChart from './components/LineChart';

import ProductPaymentsResource from '@/api/v1/product-payment';
const productPaymentResource = new ProductPaymentsResource();

export default {
  components: { Pagination, countTo, LineChart },
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
          updated_at: [new Date(new Date().getTime() - 3600 * 1000 * 24 * 7), new Date()],
        },
        list: null,
        total: 0,
        loading: false,
      },
      excel: {
        downloadLoading: false,
        filename: 'product_payment_',
        autoWidth: true,
        bookType: 'xlsx',
      },
      totalSold: 0,
      chart: {
        loading: false,
        data: {
          date: [],
          value: [],
        },
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
    productPaymentResource.totalMoney().then(response => {
      this.totalSold = response.data.data;
    });
  },
  mounted() {
    this.getChart();
  },
  methods: {
    onExcel() {
      this.excel.downloadLoading = true;
      import('@/vendor/Export2Excel').then(async excel => {
        const tHeader = [
          this.$t('table.product_payment.id'),
          this.$t('table.product_payment.total'),
          this.$t('table.product_payment.price'),
          this.$t('route.product'),
          this.$t('route.size'),
          this.$t('route.color'),
          this.$t('route.member'),
          this.$t('table.product_payment.note'),
          this.$t('date.updated_at'),
        ];
        const filterVal = [
          'id',
          'total',
          'price',
          'product_name',
          'size_name',
          'color_name',
          'member_name',
          'note',
          'updated_at',
        ];
        const filterDate = ['updated_at'];
        const {
          data: { data: productPayments },
        } = await productPaymentResource.exportExcel(this.table.listQuery);
        const data = this.formatJson(filterVal, productPayments, filterDate);
        excel.export_json_to_excel({
          header: tHeader,
          data,
          filename: this.excel.filename,
          autoWidth: this.excel.autoWidth,
          bookType: this.excel.bookType,
        });
        this.excel.downloadLoading = false;
      });
    },
    formatJson(filterVal, jsonData, filterDate) {
      return jsonData.map(v =>
        filterVal.map(j => {
          if (filterDate.includes(j) && v[j]) {
            return this.$options.filters.parseTime(v[j], '{y}-{m}-{d}');
          } else {
            if (j === 'price') {
              return this.$options.filters.currency(v[j]);
            }
            return v[j];
          }
        })
      );
    },
    onRollback(productPayment) {
      this.$confirm(
        this.$t('messages.rollback_confirm', {
          attribute: this.$t('table.product_payment.id') + '#' + productPayment.id,
        }),
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
          delete productPayment.size;
          delete productPayment.color;
          delete productPayment.member;
          delete productPayment.product;
          await productPaymentResource.rollback(productPayment);
          const index = this.table.list.findIndex(value => value.id === productPayment.id);
          this.table.list.splice(index, 1);
          this.table.loading = false;
        } catch (e) {
          this.table.loading = false;
        }
      });
    },
    getChart() {
      this.chart.loading = true;
      productPaymentResource
        .chart(this.table.listQuery.updated_at)
        .then(response => {
          const chartData = response.data.data;
          this.chart.data.date = chartData.map(val => this.$options.filters.parseTime(val.date, '{y}-{m}-{d}'));
          this.chart.data.value = chartData.map(val => val.price);
          this.chart.loading = false;
        })
        .catch(() => (this.chart.loading = false));
    },
    async getList() {
      try {
        this.table.loading = true;
        const { data } = await productPaymentResource.list(this.table.listQuery);
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
      this.getChart();
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
        this.$t('messages.delete_confirm', { attribute: this.$t('table.product_payment.id') + '#' + id }),
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
          await productPaymentResource.destroy(id);
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
.excel {
  margin: auto 0 0 0;
}
</style>

<style lang="scss" scoped>
.panel-group {
  margin-top: 18px;

  .card-panel-col {
    margin-bottom: 32px;
  }

  .card-panel {
    height: 108px;
    cursor: pointer;
    font-size: 12px;
    position: relative;
    overflow: hidden;
    color: #666;
    background: #fff;
    box-shadow: 4px 4px 40px rgba(0, 0, 0, 0.05);
    border-color: rgba(0, 0, 0, 0.05);

    &:hover {
      .card-panel-icon-wrapper {
        color: #fff;
      }

      .icon-people {
        background: #40c9c6;
      }

      .icon-message {
        background: #36a3f7;
      }

      .icon-money {
        background: #f4516c;
      }

      .icon-shopping {
        background: #34bfa3;
      }
    }

    .icon-people {
      color: #40c9c6;
    }

    .icon-message {
      color: #36a3f7;
    }

    .icon-money {
      color: #f4516c;
    }

    .icon-shopping {
      color: #34bfa3;
    }

    .card-panel-icon-wrapper {
      float: left;
      margin: 14px 0 0 14px;
      padding: 16px;
      transition: all 0.38s ease-out;
      border-radius: 6px;
    }

    .card-panel-icon {
      float: left;
      font-size: 48px;
    }

    .card-panel-description {
      float: right;
      font-weight: bold;
      margin: 26px;
      margin-left: 0px;

      .card-panel-text {
        line-height: 18px;
        color: rgba(0, 0, 0, 0.45);
        font-size: 16px;
        margin-bottom: 12px;
      }

      .card-panel-num {
        font-size: 20px;
      }
    }
  }
}
</style>
