import { useEffect } from 'react';
import { BigBanner, ClassBanner, EventList } from '../../components';
import { BaseContainer } from '../../containers';
import { homeBannerSelector, classBannerSelector, incommingEventSelector } from '../../modules';
import { getHomeBanners, getClassBanners, getIncommingEvents } from '../../services';
import { useSelector, shallowEqual } from 'react-redux';

const Homepage = () => {

  const banner = useSelector(homeBannerSelector, shallowEqual);
  const classBanner = useSelector(classBannerSelector, shallowEqual);
  const incommingEvent = useSelector(incommingEventSelector, shallowEqual);

  const banners = banner?.data || [];
  const classBanners = classBanner?.data || [];
  const events = incommingEvent?.data || [];

  useEffect(() => {
    getHomeBanners();
    getClassBanners();
    getIncommingEvents();
  }, [])

  return (
    <BaseContainer>
      <BigBanner items={banners} />
      {classBanners.map(banner => {
        return (
          <ClassBanner
            classData={banner.class}
            key={banner.id}
            sectionTitle={banner.name}
            classTitle={banner.class?.name}
            items={banner.items}
            icon={banner.image}
          />
        )
      })}

      {events && events.length > 0 ? (
        <EventList
          sectionTitle="Event yang akan datang"
          items={events}
        />
      ) : null}

    </BaseContainer >
  )
}

export default Homepage;