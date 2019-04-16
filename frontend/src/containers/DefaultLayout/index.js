// import libs
import { connect } from 'react-redux'

// import component
import DefaultLayout from './DefaultLayout';

const mapStateToProps = state => {
    return {
        isAuthenticated: state.Auth.isAuthenticated
    }
};

export default connect(mapStateToProps)(DefaultLayout)