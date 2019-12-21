export default {
  'en': {
    'auth': {
      'failed': 'These credentials do not match our records.',
      'throttle': 'Too many login attempts. Please try again in {seconds} seconds.',
      'login_fail': 'Invalid Request. Please enter a username or a password.',
      'credentials_incorrect': 'Your credentials are incorrect. Please try again',
      'server_error': 'Something went wrong on the server.',
      'login': {
        'email': 'Email',
        'password': 'Password',
        'login': 'Login',
        'remember': 'Remember',
        'forgot_password': 'Forgot password?',
      },
      'error': {
        'email': 'Email is required.',
        'email_valid': 'Invalid Email.',
        'password': 'Password is required.',
      },
      'forgot_password': 'Forgot password',
      'reset_password': 'Reset password',
      'logout': 'Logout',
    },
    'button': {
      'ok': 'OK',
      'cancel': 'Cancel',
      'create': 'Create',
      'edit': 'Edit',
      'update': 'Update',
    },
    'common': {
      'back_to_top': 'Back to top',
    },
    'date': {
      'created_at': 'Create date',
    },
    'error': {
      'is_admin': 'Can not delete admin user',
      'file_not_found': 'File not found!',
      '404': 'Page Not Found. Check if you entered an invalid link!',
    },
    'field': {
      'password': 'Password',
      'password_confirm': 'Password confirm',
      'email': 'Email',
    },
    'generator': {
      'add_field': 'Add Field',
      'generate': 'Generate',
      'generate_update': 'Update Generate',
      'confirm_remove_row': 'Delete row?',
      'no': 'No.',
      'field_name': 'Field Name',
      'field_name_trans': 'Field Name Trans',
      'db_type': 'DB Type',
      'default_value': 'Default Value',
      'after_column': 'After Column',
      'as_define': 'As define',
      'search': 'Search',
      'sort': 'Sort',
      'show': 'Show',
      'delete': 'Delete',
      'form_model_name': 'Model Name',
      'form_model_name_trans': 'Model Name Trans',
      'limit': 'Limit',
      'options': 'Options',
      'table_exist': 'Table exist!',
      'column_exist': 'Column exist!',
    },
    'messages': {
      'create': 'Created successfully!',
      'update': 'Update successfully!',
      'delete': 'Delete successfully!',
      'upload': 'Upload success!',
      'delete_confirm': 'This will permanently delete the {attribute}. Continue?',
      'warning': 'Warning',
      'success': 'Success',
      'error': 'Error',
      'info': 'Info',
    },
    'pagination': {
      'previous': '&laquo; Previous',
      'next': 'Next &raquo;',
    },
    'passwords': {
      'password': 'Passwords must be at least eight characters and match the confirmation.',
      'reset': 'Your password has been reset!',
      'sent': 'We have e-mailed your password reset link!',
      'token': 'This password reset token is invalid.',
      'user': "We can't find a user with that e-mail address.",
    },
    'route': {
      'user': 'User',
      'user_create': 'Create User',
      'user_edit': 'Edit User',
      'generator': 'Generator',
      'generator_create': 'Generator Create',
      'generator_edit': 'Generator Edit',
      'generator_relationship': 'Relationship',
      'dashboard': 'Dashboard',
      'administrator': 'Administrator',
      'role_permission': 'Role Permission',
    },
    'table': {
      'actions': 'Actions',
      'user': {
        'id': 'No.',
        'name': 'Name',
        'email': 'Email',
        'avatar': 'Avatar',
        'role': 'Role',
        'password': 'Password',
        'password_confirmation': 'Confirmation password',
      },
      'rolePermission': {
        'id': 'No.',
        'name': 'Name',
        'description': 'Description',
      },
      'texts': {
        'count': 'Showing {from} to {to} of {count} records|{count} records|One record',
        'first': 'First',
        'last': 'Last',
        'filter': 'Filter:',
        'filterPlaceholder': 'Search...',
        'limit': 'Records:',
        'page': 'Page:',
        'noResults': 'No matching records',
        'filterBy': 'Filter by {column}',
        'loading': 'Loading...',
        'defaultOption': 'Select {column}',
        'columns': 'Columns',
      },
    },
    'tagsView': {
      'refresh': 'Refresh',
      'close': 'Close',
      'closeOthers': 'Close Others',
      'closeAll': 'Close All',
    },
    'validation': {
      'accepted': 'The {attribute} must be accepted.',
      'active_url': 'The {attribute} is not a valid URL.',
      'after': 'The {attribute} must be a date after {date}.',
      'after_or_equal': 'The {attribute} must be a date after or equal to {date}.',
      'alpha': 'The {attribute} may only contain letters.',
      'alpha_dash': 'The {attribute} may only contain letters, numbers, dashes and underscores.',
      'alpha_num': 'The {attribute} may only contain letters and numbers.',
      'array': 'The {attribute} must be an array.',
      'before': 'The {attribute} must be a date before {date}.',
      'before_or_equal': 'The {attribute} must be a date before or equal to {date}.',
      'between': {
        'numeric': 'The {attribute} must be between {min} and {max}.',
        'file': 'The {attribute} must be between {min} and {max} kilobytes.',
        'string': 'The {attribute} must be between {min} and {max} characters.',
        'array': 'The {attribute} must have between {min} and {max} items.',
      },
      'boolean': 'The {attribute} field must be true or false.',
      'confirmed': 'The {attribute} confirmation does not match.',
      'date': 'The {attribute} is not a valid date.',
      'date_equals': 'The {attribute} must be a date equal to {date}.',
      'date_format': 'The {attribute} does not match the format {format}.',
      'different': 'The {attribute} and {other} must be different.',
      'digits': 'The {attribute} must be {digits} digits.',
      'digits_between': 'The {attribute} must be between {min} and {max} digits.',
      'dimensions': 'The {attribute} has invalid image dimensions.',
      'distinct': 'The {attribute} field has a duplicate value.',
      'email': 'The {attribute} must be a valid email address.',
      'exists': 'The selected {attribute} is invalid.',
      'file': 'The {attribute} must be a file.',
      'filled': 'The {attribute} field must have a value.',
      'gt': {
        'numeric': 'The {attribute} must be greater than {value}.',
        'file': 'The {attribute} must be greater than {value} kilobytes.',
        'string': 'The {attribute} must be greater than {value} characters.',
        'array': 'The {attribute} must have more than {value} items.',
      },
      'gte': {
        'numeric': 'The {attribute} must be greater than or equal {value}.',
        'file': 'The {attribute} must be greater than or equal {value} kilobytes.',
        'string': 'The {attribute} must be greater than or equal {value} characters.',
        'array': 'The {attribute} must have {value} items or more.',
      },
      'image': 'The {attribute} must be an image.',
      'in': 'The selected {attribute} is invalid.',
      'in_array': 'The {attribute} field does not exist in {other}.',
      'integer': 'The {attribute} must be an integer.',
      'ip': 'The {attribute} must be a valid IP address.',
      'ipv4': 'The {attribute} must be a valid IPv4 address.',
      'ipv6': 'The {attribute} must be a valid IPv6 address.',
      'json': 'The {attribute} must be a valid JSON string.',
      'lt': {
        'numeric': 'The {attribute} must be less than {value}.',
        'file': 'The {attribute} must be less than {value} kilobytes.',
        'string': 'The {attribute} must be less than {value} characters.',
        'array': 'The {attribute} must have less than {value} items.',
      },
      'lte': {
        'numeric': 'The {attribute} must be less than or equal {value}.',
        'file': 'The {attribute} must be less than or equal {value} kilobytes.',
        'string': 'The {attribute} must be less than or equal {value} characters.',
        'array': 'The {attribute} must not have more than {value} items.',
      },
      'max': {
        'numeric': 'The {attribute} may not be greater than {max}.',
        'file': 'The {attribute} may not be greater than {max} kilobytes.',
        'string': 'The {attribute} may not be greater than {max} characters.',
        'array': 'The {attribute} may not have more than {max} items.',
      },
      'mimes': 'The {attribute} must be a file of type: {values}.',
      'mimetypes': 'The {attribute} must be a file of type: {values}.',
      'min': {
        'numeric': 'The {attribute} must be at least {min}.',
        'file': 'The {attribute} must be at least {min} kilobytes.',
        'string': 'The {attribute} must be at least {min} characters.',
        'array': 'The {attribute} must have at least {min} items.',
      },
      'not_in': 'The selected {attribute} is invalid.',
      'not_regex': 'The {attribute} format is invalid.',
      'numeric': 'The {attribute} must be a number.',
      'present': 'The {attribute} field must be present.',
      'regex': 'The {attribute} format is invalid.',
      'required': 'The {attribute} field is required.',
      'required_if': 'The {attribute} field is required when {other} is {value}.',
      'required_unless': 'The {attribute} field is required unless {other} is in {values}.',
      'required_with': 'The {attribute} field is required when {values} is present.',
      'required_with_all': 'The {attribute} field is required when {values} are present.',
      'required_without': 'The {attribute} field is required when {values} is not present.',
      'required_without_all': 'The {attribute} field is required when none of {values} are present.',
      'same': 'The {attribute} and {other} must match.',
      'size': {
        'numeric': 'The {attribute} must be {size}.',
        'file': 'The {attribute} must be {size} kilobytes.',
        'string': 'The {attribute} must be {size} characters.',
        'array': 'The {attribute} must contain {size} items.',
      },
      'starts_with': 'The {attribute} must start with one of the following: {values}',
      'string': 'The {attribute} must be a string.',
      'timezone': 'The {attribute} must be a valid zone.',
      'unique': 'The {attribute} has already been taken.',
      'uploaded': 'The {attribute} failed to upload.',
      'url': 'The {attribute} format is invalid.',
      'uuid': 'The {attribute} must be a valid UUID.',
      'custom': {
        'attribute-name': {
          'rule-name': 'custom-message',
        },
      },
      'attributes': [],
    },
  },
  'vn': {
    'auth': {
      'failed': 'Những thông tin không phù hợp với hồ sơ của chúng tôi.',
      'throttle': 'Quá nhiều lần thử đăng nhập. Vui lòng thử lại sau {seconds} giây.',
      'login_fail': 'Yêu cầu không hợp lệ. Vui lòng nhập tên người dùng hoặc mật khẩu.',
      'credentials_incorrect': 'Thông tin của bạn không chính xác. Vui lòng thử lại sai',
      'server_error': 'Something went wrong on the server.',
      'login': {
        'email': 'Email',
        'password': 'Mật khẩu',
        'login': 'Đăng nhập',
        'remember': 'Ghi nhớ',
        'forgot_password': 'Quên mật khẩu?',
      },
      'error': {
        'email': 'Email bắt buộc.',
        'email_valid': 'Email không hợp lệ',
        'password': 'Password bắt buộc.',
      },
      'forgot_password': 'Quên mật khẩu',
      'reset_password': 'Đặt lại mật khẩu',
      'logout': 'Đăng xuất',
    },
    'button': {
      'ok': 'Xác nhận',
      'cancel': 'Bỏ qua',
      'create': 'Tạo',
      'edit': 'Sửa',
      'update': 'Cập nhật',
    },
    'common': {
      'back_to_top': 'Trở lại đầu trang',
    },
    'date': {
      'created_at': 'Ngày tạo',
    },
    'error': {
      'is_admin': 'Không thể xóa Admin',
      'file_not_found': 'File không tồn tại!',
      '404': 'Không tìm thấy trang. Kiểm tra nếu bạn nhập một liên kết không hợp lệ!',
    },
    'field': {
      'password': 'Mật khẩu',
      'password_confirm': 'Xác nhận mật khẩu',
    },
    'generator': {
      'add_field': 'Thêm Field',
      'generate': 'Tạo Generate',
      'generate_update': 'Cập nhật Generate',
      'confirm_remove_row': 'Xóa dòng?',
      'no': 'STT.',
      'field_name': 'Tên Trường',
      'field_name_trans': 'Tên Hiển Thị',
      'db_type': 'Kiểu dữ liểu',
      'default_value': 'Giá trị mặc định',
      'after_column': 'Sau Cột',
      'as_define': 'Định nghĩa',
      'search': 'Tìm Kiếm',
      'sort': 'Sắp xếp',
      'show': 'Hiển thị',
      'delete': 'Xóa',
      'form_model_name': 'Tên Modal',
      'form_model_name_trans': 'Tên Modal Hiển Thị',
      'limit': 'Giới hạn',
      'options': 'Tùy chỉnh',
      'table_exist': 'Table đã tồn tài!',
      'column_exist': 'Column đã tồn tài!',
    },
    'messages': {
      'create': 'Tạo thành công!',
      'update': 'Cập nhật thành công!',
      'delete': 'Xóa thành công!',
      'delete_confirm': 'Điều này sẽ xóa vĩnh viễn {attribute}. Tiếp tục?',
      'warning': 'Cảnh báo',
      'success': 'Thành công',
      'error': 'Lỗi',
      'info': 'Thông báo',
    },
    'route': {
      'user': 'Nhân viên',
      'user_create': 'Tạo Nhân viên',
      'user_edit': 'Sửa Nhân viên',
      'generator': 'Generator',
      'generator_create': 'Generator Create',
      'generator_edit': 'Generator Edit',
      'generator_relationship': 'Relationship',
      'dashboard': 'Bảng điều khiển',
      'administrator': 'Administrator',
      'role_permission': 'Role Permission',
    },
    'table': {
      'actions': 'Actions',
      'user': {
        'id': 'STT',
        'name': 'Tên',
        'email': 'Email',
        'avatar': 'Ảnh đại diện',
        'role': 'Quyền',
        'password': 'Mật khẩu',
        'password_confirmation': 'Xác nhận mật khẩu',
      },
      'rolePermission': {
        'id': 'No.',
        'name': 'Tên',
        'description': 'Miêu tả',
      },
      'texts': {
        'count': 'Hiển thị {from} đến {to} trong số {count} dữ liệu|{count} dữ liệu|Một dữ liệu',
        'first': 'Đầu',
        'last': 'Cuối',
        'filter': 'Bộ lọc:',
        'filterPlaceholder': 'Tìm kiếm...',
        'limit': 'Giới hạn:',
        'page': 'Trang:',
        'noResults': 'Không có dữ liệu phù hợp',
        'filterBy': 'Lọc bởi {column}',
        'loading': 'Chờ đợi...',
        'defaultOption': 'Chọn {column}',
        'columns': 'Cột',
      },
    },
    'tagsView': {
      'refresh': 'Refresh',
      'close': 'Close',
      'closeOthers': 'Close Others',
      'closeAll': 'Close All',
    },
    'validation': {
      'accepted': 'The {attribute} must be accepted.',
      'active_url': 'The {attribute} is not a valid URL.',
      'after': 'The {attribute} must be a date after {date}.',
      'after_or_equal': 'The {attribute} must be a date after or equal to {date}.',
      'alpha': 'The {attribute} may only contain letters.',
      'alpha_dash': 'The {attribute} may only contain letters, numbers, dashes and underscores.',
      'alpha_num': 'The {attribute} may only contain letters and numbers.',
      'array': 'The {attribute} must be an array.',
      'before': 'The {attribute} must be a date before {date}.',
      'before_or_equal': 'The {attribute} must be a date before or equal to {date}.',
      'between': {
        'numeric': 'The {attribute} must be between {min} and {max}.',
        'file': 'The {attribute} must be between {min} and {max} kilobytes.',
        'string': 'The {attribute} must be between {min} and {max} characters.',
        'array': 'The {attribute} must have between {min} and {max} items.',
      },
      'boolean': 'The {attribute} field must be true or false.',
      'confirmed': '{attribute} xác nhận không phù hợp.',
      'date': 'The {attribute} is not a valid date.',
      'date_equals': 'The {attribute} must be a date equal to {date}.',
      'date_format': 'The {attribute} does not match the format {format}.',
      'different': 'The {attribute} and {other} must be different.',
      'digits': 'The {attribute} must be {digits} digits.',
      'digits_between': 'The {attribute} must be between {min} and {max} digits.',
      'dimensions': 'The {attribute} has invalid image dimensions.',
      'distinct': 'The {attribute} field has a duplicate value.',
      'email': '{attribute} phải là một địa chỉ hợp lệ.',
      'exists': 'The selected {attribute} is invalid.',
      'file': 'The {attribute} must be a file.',
      'filled': 'The {attribute} field must have a value.',
      'gt': {
        'numeric': 'The {attribute} must be greater than {value}.',
        'file': 'The {attribute} must be greater than {value} kilobytes.',
        'string': 'The {attribute} must be greater than {value} characters.',
        'array': 'The {attribute} must have more than {value} items.',
      },
      'gte': {
        'numeric': 'The {attribute} must be greater than or equal {value}.',
        'file': 'The {attribute} must be greater than or equal {value} kilobytes.',
        'string': 'The {attribute} must be greater than or equal {value} characters.',
        'array': 'The {attribute} must have {value} items or more.',
      },
      'image': 'The {attribute} must be an image.',
      'in': 'The selected {attribute} is invalid.',
      'in_array': 'The {attribute} field does not exist in {other}.',
      'integer': 'The {attribute} must be an integer.',
      'ip': 'The {attribute} must be a valid IP address.',
      'ipv4': 'The {attribute} must be a valid IPv4 address.',
      'ipv6': 'The {attribute} must be a valid IPv6 address.',
      'json': 'The {attribute} must be a valid JSON string.',
      'lt': {
        'numeric': 'The {attribute} must be less than {value}.',
        'file': 'The {attribute} must be less than {value} kilobytes.',
        'string': 'The {attribute} must be less than {value} characters.',
        'array': 'The {attribute} must have less than {value} items.',
      },
      'lte': {
        'numeric': 'The {attribute} must be less than or equal {value}.',
        'file': 'The {attribute} must be less than or equal {value} kilobytes.',
        'string': 'The {attribute} must be less than or equal {value} characters.',
        'array': 'The {attribute} must not have more than {value} items.',
      },
      'max': {
        'numeric': 'The {attribute} may not be greater than {max}.',
        'file': 'The {attribute} may not be greater than {max} kilobytes.',
        'string': 'The {attribute} may not be greater than {max} characters.',
        'array': 'The {attribute} may not have more than {max} items.',
      },
      'mimes': 'The {attribute} must be a file of type: {values}.',
      'mimetypes': 'The {attribute} must be a file of type: {values}.',
      'min': {
        'numeric': 'The {attribute} must be at least {min}.',
        'file': 'The {attribute} must be at least {min} kilobytes.',
        'string': 'The {attribute} must be at least {min} characters.',
        'array': 'The {attribute} must have at least {min} items.',
      },
      'not_in': 'The selected {attribute} is invalid.',
      'not_regex': 'The {attribute} format is invalid.',
      'numeric': 'The {attribute} must be a number.',
      'present': 'The {attribute} field must be present.',
      'regex': 'The {attribute} format is invalid.',
      'required': '{attribute} phải bắt buộc.',
      'required_if': 'The {attribute} field is required when {other} is {value}.',
      'required_unless': 'The {attribute} field is required unless {other} is in {values}.',
      'required_with': 'The {attribute} field is required when {values} is present.',
      'required_with_all': 'The {attribute} field is required when {values} are present.',
      'required_without': 'The {attribute} field is required when {values} is not present.',
      'required_without_all': 'The {attribute} field is required when none of {values} are present.',
      'same': 'The {attribute} and {other} must match.',
      'size': {
        'numeric': 'The {attribute} must be {size}.',
        'file': 'The {attribute} must be {size} kilobytes.',
        'string': 'The {attribute} must be {size} characters.',
        'array': 'The {attribute} must contain {size} items.',
      },
      'starts_with': 'The {attribute} must start with one of the following: {values}',
      'string': 'The {attribute} must be a string.',
      'timezone': 'The {attribute} must be a valid zone.',
      'unique': '{attribute} đã tồn tại.',
      'uploaded': 'The {attribute} failed to upload.',
      'url': 'The {attribute} format is invalid.',
      'uuid': 'The {attribute} must be a valid UUID.',
      'custom': {
        'attribute-name': {
          'rule-name': 'custom-message',
        },
      },
      'attributes': [],
    },
  },
};
