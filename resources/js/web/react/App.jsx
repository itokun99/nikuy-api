import { useEffect } from 'react';
import { BrowserRouter, Route, Switch, Redirect } from 'react-router-dom';
import Community from './pages/Community';
import Contact from './pages/Contact';
import Course from './pages/Course';
import CourseDetail from './pages/CourseDetail';
import Event from './pages/Event';
import Forum from './pages/Forum';
import Homepage from './pages/Homepage';
import Privacy from './pages/Privacy';
import Profile from './pages/Profile';
import Business from './pages/Business';
import BusinessDetail from './pages/Business/BusinessDetail';
import Membership from './pages/Membership';
import Transaction from './pages/Transaction';
import CommingSoon from './pages/CommingSoon';
import TransactionConfirmation from './pages/TransactionConfirmation';
import { useSelector, shallowEqual } from 'react-redux';
import { profileAccountSelector, loadingSelector } from './modules';
import { getProfile } from './services';
import { getTokenFromStorage } from './utils';
import { ToastContainer } from 'react-toastify';
import { Loading } from './components';
import { showLoading } from './controls';


const App = () => {

  const token = getTokenFromStorage();
  const account = useSelector(profileAccountSelector, shallowEqual);
  const loading = useSelector(loadingSelector, shallowEqual);

  useEffect(() => {
    if (token && !account) {
      showLoading(true)
      getProfile().then(() => {
        showLoading(false);
      }).catch(() => {
        showLoading(false);
      });
    }
  }, [token, account])

  return (
    <>
      <BrowserRouter>
        <Switch>
          <Route path="/profile/business/add" exact component={BusinessDetail} />
          <Route path="/profile/business/:id" exact component={BusinessDetail} />
          <Route path="/profile/business" exact component={Business} />
          <Route path="/profile" exact component={Profile} />
          <Route path="/community" exact component={CommingSoon} />
          <Route path="/contact" exact component={Contact} />
          <Route path="/course/:id/:pillarId/:courseId" exact component={CourseDetail} />
          <Route path="/course/:id/:pillarId" exact component={CourseDetail} />
          <Route path="/course/:id" exact component={CourseDetail} />
          <Route path="/course" exact component={Course} />
          <Route path="/event" exact component={Event} />
          <Route path="/forum" exact component={CommingSoon} />
          <Route path="/privacy" exact component={CommingSoon} />
          <Route path="/membership" exact component={Membership} />
          <Route path="/transaction/:id" exact component={TransactionConfirmation} />
          <Route path="/transaction" exact component={Transaction} />
          <Route path="/" exact component={Homepage} />
        </Switch>
      </BrowserRouter>
      <Loading {...loading} />
      <ToastContainer
        position="top-center"
        autoClose={3000}
        hideProgressBar
        newestOnTop={false}
        closeOnClick
        rtl={false}
        pauseOnFocusLoss
        draggable
        pauseOnHover
      />
    </>
  )
}

export default App;