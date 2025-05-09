const updateBusinessDetailsApi = async () => {
    try {
      if (!user?.business_id) {
        showToast('e', 'Business ID is missing!');
        return;
      }
  
      if (!logo?.uri) {
        showToast('e', 'Please select a logo');
        return;
      }
  
      const formData = new FormData();
      formData.append('business_name', businessName);
      formData.append('business_type', industryType?.title);
      formData.append('your_name', `${user?.firstname} ${user?.lastname}`);
      formData.append('phone', user?.phone);
      formData.append('country_code', user?.country_code);
      formData.append('team_size', selectedTeamsize?.title);
  
      console.log('Uploading logo:', logo);
  
      // ✅ Ensure correct file format
      if (logo.uri) {
        let fileUri = logo.uri;
        if (Platform.OS === 'ios') {
          fileUri = fileUri.replace('file://', ''); // Remove 'file://' for iOS
        }
  
        formData.append('logo', {
          uri: fileUri,
          type: logo.type || 'image/jpeg', 
          name: logo.fileName || `logo_${Date.now()}.jpg`, 
        });
      }
  
      const apiUrl = '';
      console.log('API URL:', apiUrl);
  
      const response = await fetch(apiUrl, {
        method: 'POST',
        body: formData, 
        headers: {
          Authorization: `Bearer ${user?.token}`,
        }, // ❌ Don't set 'Content-Type', React Native will handle it
      });
  
      const result = await response.json();
      console.log('API Response:', result);
  
      if (response.ok) {
        showToast('s', 'Business details updated successfully!');
        props.navigation.goBack();
      } else {
        showToast('e', result?.message || 'Failed to update business details');
      }
  
    } catch (error) {
      console.error('Error updating business details:', error);
      showToast('e', error.message || 'Something went wrong');
    } finally {
      setLoading(false);
    }
  };