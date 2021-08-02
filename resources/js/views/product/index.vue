<template>
  <el-row>
    <el-col :span="24">
      <el-card>
        <div slot="header" class="tw-flex tw-justify-end tw-items-center">
          <router-link v-slot="{ href, navigate }" v-permission="['create']" :to="{name: 'ProductCreate'}" custom>
            <a :href="href" class="pan-btn blue-btn" @click="navigate">
              <i class="el-icon-plus mr-2" />
              {{ $t('button.create') }}
            </a>
          </router-link>
        </div>
        <el-row :gutter="20" class="tw-mb-6">
          <el-col :xs="24" :sm="10" :md="6">
            <label>{{ $t('table.texts.filter') }}</label>
            <el-input v-model="table.listQuery.search" :placeholder="$t('table.texts.filterPlaceholder')" />
          </el-col>
          <el-col :xs="24" :sm="14" :md="18">
            <br />
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
        <el-row :gutter="20">
          <el-col :span="24" class="table-responsive">
            <el-table
              v-loading="table.loading"
              class="tw-w-full"
              :data="table.list"
              :default-sort="{prop: 'updated_at', order: 'descending'}"
              border
              fit
              highlight-current-row
              @sort-change="sortChange"
            >
              <el-table-column align="center" sortable="custom" prop="id" :label="$t('table.product.id')" width="70px">
                <template slot-scope="{ row }">
                  {{ row.id }}
                </template>
              </el-table-column>
              <el-table-column data-generator="code" prop="code" :label="$t('table.product.code')" align="left" header-align="center">
                <template slot-scope="{ row }">
                  {{ row.code }}
                </template>
              </el-table-column>
              <el-table-column data-generator="name" prop="name" :label="$t('table.product.name')" align="left" header-align="center">
                <template slot-scope="{ row }">
                  {{ row.name }}
                </template>
              </el-table-column>
              <el-table-column data-generator="image" prop="image" :label="$t('table.product.image')" align="left" header-align="center">
                <template slot-scope="{ row }">
                  {{ row.image }}
                </template>
              </el-table-column>
              <el-table-column data-generator="description" prop="description" :label="$t('table.product.description')" align="left" header-align="center">
                <template slot-scope="{ row }">
                  {{ row.description }}
                </template>
              </el-table-column>
              <el-table-column data-generator="stock_in" prop="stock_in" :label="$t('table.product.stock_in')" align="center" header-align="center">
                <template slot-scope="{ row }">
                  {{ row.stock_in }}
                </template>
              </el-table-column>
              <el-table-column data-generator="stock_out" prop="stock_out" :label="$t('table.product.stock_out')" align="center" header-align="center">
                <template slot-scope="{ row }">
                  {{ row.stock_out }}
                </template>
              </el-table-column>
              <el-table-column data-generator="inventory" prop="inventory" :label="$t('table.product.inventory')" align="center" header-align="center">
                <template slot-scope="{ row }">
                  {{ row.inventory }}
                </template>
              </el-table-column>
              <el-table-column data-generator="price" prop="price" :label="$t('table.product.price')" align="center" header-align="center">
                <template slot-scope="{ row }">
                  {{ row.price }}
                </template>
              </el-table-column>
              <el-table-column data-generator="discount" prop="discount" :label="$t('table.product.discount')" align="center" header-align="center">
                <template slot-scope="{ row }">
                  {{ row.discount }}
                </template>
              </el-table-column>
              <el-table-column data-generator="status" prop="status" :label="$t('table.product.status')" align="center" header-align="center">
                <template slot-scope="{ row }">
                  <el-tag>{{ row.status === 0 ? 'false' : 'true' }}</el-tag>
                </template>
              </el-table-column>
              <!--{{$TEMPLATES_NOT_DELETE_THIS_LINE$}}-->
              <el-table-column data-generator="updated_at" prop="updated_at" :label="$t('date.updated_at')" sortable="custom" align="center" header-align="center">
                <template slot-scope="{ row }">
                  {{ row.updated_at | parseTime('{y}-{m}-{d} {h}:{i}') }}
                </template>
              </el-table-column>
              <el-table-column :label="$t('table.actions')" align="center" class-name="small-padding fixed-width">
                <template slot-scope="{ row }">
                  <router-link v-permission="['edit']" :to="{name: 'ProductEdit', params: {id: row.id}}"><i class="el-icon-edit el-link el-link--primary tw-mr-2" /></router-link>
                  <a v-permission="['delete']" class="cursor-pointer" @click.stop="() => remove(row.id)"><i class="el-icon-delete el-link el-link--danger" /></a>
                </template>
              </el-table-column>
            </el-table>
            <pagination v-if="table.total > 0" :total="table.total" :page.sync="table.listQuery.page" :limit.sync="table.listQuery.limit" @pagination="getList" />
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
  import ProductsResource from '@/api/v1/product';
  const productResource = new ProductsResource();

  export default {
    components: { Pagination },
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
      };
    },
    watch: {
      'table.listQuery.search': debounce(function () {
        this.handleFilter();
      }, 500),
    },
    created() {
      this.getList();
    },
    methods: {
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
        this.$confirm(this.$t('messages.delete_confirm', { attribute: this.$t('table.product.id') + '#' + id }), this.$t('messages.warning'), {
          confirmButtonText: this.$t('button.ok'),
          cancelButtonClass: this.$t('button.cancel'),
          type: 'warning',
          center: true,
        }).then(async () => {
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
